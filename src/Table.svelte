<script lang="ts">
  import { onMount } from "svelte";
  import { config } from "./store";
  import TableColumn from "./TableColumn.svelte";
  import { gSectionNameMap } from "./globals";

  let maxColumnHeight = 0;
  let parsedData: ParsedData = {
    1: [],
    101: [],
    150: [],
    200: [],
    250: [],
  };

  const parseData = (data: string): ParsedData => {
    let currentSection: SectionNr = "1";
    let retData: ParsedData = {
      1: [],
      101: [],
      150: [],
      200: [],
      250: [],
    };

    let lines = data.split("\n");
    // Beginn bei 1, da erste Zeile "1" ist/Startfall
    for (let a = 1; a < lines.length; a++) {
      if (lines[a] === "") {
        //Damit SectionNr in nächster Line nicht beim nächsten Durchlauf gepusht wird
        a++;
        currentSection = lines[a] as SectionNr;
      } else {
        retData[currentSection].push(lines[a]);
      }
    }
    return retData;
  };

  const calcMaxColumnHeight = (parsedData: ParsedData) => {
    let maxVal = 0;
    Object.values(parsedData).forEach((x) => {
      maxVal = Math.max(maxVal, x.length);
    });
    return maxVal;
  };

  const uFetchData = () => {
    fetch($config.serverPath, {
      method: "GET",
    }).then(
      (x) => {
        x.text().then((x) => {
          parsedData = parseData(x);
          parsedData = parsedData;
          maxColumnHeight = calcMaxColumnHeight(parsedData);
          console.log("m", maxColumnHeight);
        });
      },
      (x) => {
        console.log("Fehler beim Zugriff auf Server:", x);
        console.log("Möglicher Fall: Datei existiert nicht");
      }
    );
  };

  onMount(() => {
    fetch("./config.json").then((x) => {
      x.json().then((x) => {
        config.set(x);
        uFetchData();
        setInterval(() => {
          uFetchData();
        }, 2_000);
      });
    });
  });
</script>

<div
  style="display: flex; flex-direction: row; width:fit-content; height: 200px; overflow-y: scroll;"
>
  {#each Object.entries(parsedData) as [key, value]}
    <TableColumn
      columnName={gSectionNameMap[key]}
      vals={value}
      height={maxColumnHeight}
    />
  {/each}
</div>

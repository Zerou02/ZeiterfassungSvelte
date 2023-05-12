<script lang="ts">
  import { onMount } from "svelte";
  import TableRow from "./TableRow.svelte";
  import { config } from "./store";

  let delta = 0;
  let parsedData: ParsedData = {
    1: ["Max Mustermann"],
    101: ["Max Mustermann"],
    150: ["Max Mustermann"],
    200: ["Max Mustermann"],
    250: ["Max Mustermann"],
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
        //        retData[currentSection].push(lines[a]);
        retData[currentSection].push("Mustermann, Max");
      }
    }
    return retData;
  };

  const uFetchData = () => {
    fetch($config.serverPath, {
      method: "GET",
    }).then(
      (x) => {
        x.text().then((x) => {
          parsedData = parseData(x);
          parsedData = parsedData;
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
        delta = 0;
      });
    });
  });
</script>

<div style="display: flex; flex-direction: row; gap:20px">
  {#each Object.entries(parsedData) as [key, value]}
    <TableRow columnName={key} vals={value} />
  {/each}
</div>

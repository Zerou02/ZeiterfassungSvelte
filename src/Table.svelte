<script lang="ts">
  import { onMount } from "svelte";
  import TableRow from "./TableRow.svelte";
  import TableColumn from "./TableColumn.svelte";
  import { SectionNrNameMap, type SectionName } from "./types";
  import { type ParsedData, type SectionNr } from "./types"
  import { config } from "./store";

  let delta = 0;
  let parsedData: ParsedData = {
    1: ["Max Mustermann", "Max Mustermann", "Max Mustermann"],
    101: ["Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann"],
    200: ["Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann"],
    150: ["Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann", "Max Mustermann","Max Mustermann", "Max Mustermann", "Max Mustermann"],
    // 200: ["Max Mustermann", "Max Mustermann", "Max Mustermann"],
    250: ["Max Mustermann", "Max Mustermann", "Max Mustermann"],
  };

  let authorized = true;

  const filterData = (data: ParsedData): [string, string[]][] => {
     return Object.entries(parsedData)
            .sort((a, b) => Number(a[0]) - Number(b[0]))
            .filter(([nr,_]) => authorized ? true : nr !== "1")
  }

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
    // fetch("./config.json").then((x) => {
    //   x.json().then((x) => {
    //     config.set(x);
    //     uFetchData();
    //     setInterval(() => {
    //       uFetchData();
    //     }, 2_000);
    //     delta = 0;
    //   });
    // });
  });
</script>

<style>
  .table {
    max-width: 95vw;
    max-height: 95vh;
    overflow: hidden;
    display: flex;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    user-select: none;
    background-color: aliceblue;
    --blue: #00529e;
    border-radius: 5px;
    border: 2px solid var(--blue);
  }
</style>

<div class="table">
  {#each filterData(parsedData) as [key, values]}
    <TableColumn name={SectionNrNameMap[key]} values={values} />
  {/each}
</div>

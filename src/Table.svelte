<script lang="ts">
  import { onMount } from "svelte";
  import { config } from "./store";
  import TableRow from "./TableRow.svelte";
  import { gSectionNameMap } from "./globals";

  let tableData: TableParsedData = [];
  let sections: string[] = [];

  const parseData = (data: string): ParsedData => {
    if ($config.debug) {
      console.log("raw data", data);
    }
    let currentSection: SectionNr = "1";
    let retData: ParsedData = {
      1: [],
      101: [],
      150: [],
      200: [],
      250: [],
    };

    let lines = data
      .replaceAll("\r", "")
      .replaceAll("<h2>", "")
      .replaceAll("</h2>", "")
      .replaceAll("No rows found", "")
      .replaceAll("Name_Vorname", "")
      .replaceAll("<table  >", "")
      .replaceAll("</table>", "")
      .replaceAll("<tr>", "")
      .replaceAll("</tr>", "")
      .replaceAll("<th>", "")
      .replaceAll("</th>", "")
      .replaceAll("<td>", "")
      .replaceAll("</td>", "")
      .split("\n")
      .filter((x) => x !== "");

    for (let a = 0; a < lines.length; a++) {
      if (lines[a].includes("Abteilung")) {
        let shortened = lines[a].replaceAll(" ", "").split("Abteilung");
        currentSection = shortened[shortened.length - 1] as SectionNr;
      } else {
        if (lines[a].length > 2) {
          retData[currentSection].push(lines[a]);
        }
      }
    }
    if (!$config.seeAll) {
      delete retData["1"];
    }
    if ($config.debug) {
      console.log("parsedData", retData);
    }
    return retData;
  };

  const parseTableData = (parsedData: ParsedData): TableParsedData => {
    let retData: TableParsedData = [];
    let maxColumnHeight = calcMaxColumnHeight(parsedData);
    let columns = Object.values(parsedData);
    for (let a = 0; a < maxColumnHeight; a++) {
      let row: string[] = [];
      columns.forEach((x) => {
        row.push(x[a] || "");
      });
      retData.push(row);
    }
    if ($config.debug) {
      console.log("tableData", retData);
    }
    return retData;
  };

  const parseSectionNames = (parsedData: ParsedData): string[] => {
    let retVal = [];
    Object.keys(parsedData).forEach((x) => {
      retVal.push(gSectionNameMap[x]);
    });
    return retVal;
  };

  const calcMaxColumnHeight = (parsedData: ParsedData) => {
    let maxVal = 0;
    Object.values(parsedData).forEach((x) => {
      maxVal = Math.max(maxVal, x.length);
    });
    return maxVal;
  };

  const uFetchData = () => {
    fetch($config.env === "prod" ? $config.serverPath : "mockData.txt", {
      method: "GET",
    }).then(
      (x) => {
        x.text().then((x) => {
          let parsedData = parseData(x);
          tableData = parseTableData(parsedData);
          sections = parseSectionNames(parsedData);
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

<div id="table_wrapper" style="display: flex; flex-direction: column; ">
  <div id="table_header_row_wrapper">
    <TableRow data={sections} isHeader />
  </div>
  <div id="table_body">
    {#each tableData as row}
      <TableRow data={row} isHeader={false} />
    {/each}
  </div>
</div>

<style>
  #table_body {
    height: 100%;
    overflow-y: scroll;
    background-color: rgba(4, 64, 155, 0.95);
    scrollbar-color: #fff rgb(4, 64, 155);
    scrollbar-width: thin;
  }
  #table_wrapper {
    width: 70%;
    height: 80vh;
  }
  #table_header_row_wrapper {
    overflow-y: scroll;
    scrollbar-width: thin;
    scrollbar-color: rgba(4, 64, 155, 0.9) rgba(4, 64, 155, 0.9);
    height: 56px;
  }
</style>

<script lang="ts">
  import TableCell from "./TableCell.svelte";

  export let columnName: string;
  export let vals: string[];
  export let height: number;

  $: emptyCells = height - vals.length;
  $: console.log("e,", height, vals.length, emptyCells);
</script>

<div id={"column_" + columnName} style="display: flex; flex-direction:column; ">
  <div
    class="header_cell"
    style="background: linear-gradient(rgb(46, 79, 143), rgb(4, 4, 155));"
  >
    <p>
      {columnName}
    </p>
  </div>
  <div class="column_body">
    {#each vals as x}
      <TableCell isHeader val={x} />
    {/each}
    {#each Array(Math.max(0, emptyCells)) as x}
      <TableCell isHeader val={""} />
    {/each}
  </div>
</div>

<style>
  p {
    color: white;
    text-align: center;
  }
  .header_cell {
    border: 1px solid rgb(87, 130, 218);
  }
</style>

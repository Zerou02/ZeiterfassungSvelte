<script lang="ts">
  import TableCell from "./TableCell.svelte";

  export let columnName: string;
  export let vals: string[];
  export let height: number;

  $: emptyCells = height - vals.length;
  $: console.log("e,", height, vals.length, emptyCells);
</script>

<div
  id={"column_" + columnName}
  style="display: flex; flex-direction:column; height: fit-content;"
>
  <div
    class="header_cell"
    style="background: linear-gradient(rgb(46, 79, 143), rgb(4, 4, 155));"
  >
    <p>
      {columnName}
    </p>
  </div>
  {#each vals as x}
    <TableCell val={x} />
  {/each}
  {#each Array(Math.max(0, emptyCells)) as x}
    <TableCell val={""} />
  {/each}
</div>

<style>
  p {
    color: white;
    text-align: center;
  }
  .header_cell {
    border: 1px solid rgb(87, 130, 218);
    min-width: 100px;
  }
</style>

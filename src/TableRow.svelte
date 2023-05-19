<script lang="ts">
  import TableCell from "./TableCell.svelte";

  export let data: string[];
  export let isHeader: boolean;
</script>

<div class="column_row">
  {#each data as entry, i}
    <TableCell {isHeader} val={entry} rightmost={i === data.length - 1} />
  {/each}
</div>

<style>
  .column_row {
    display: flex;
    flex-direction: row;
  }
</style>

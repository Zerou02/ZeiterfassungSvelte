<script lang="ts">
  export let columnName: string;
  export let vals: string[];
</script>

<div id={"column_" + columnName} style="display: flex; flex-direction:column">
  <div>
    {columnName}
  </div>
  {#each vals as x}
    <div>{x}</div>
  {/each}
</div>

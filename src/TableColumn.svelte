<script lang="ts">
  import { type SectionName } from "./types";
  export let name: SectionName;
  export let values: string[];
</script>

<style>
    .column {
        display: flex;
        flex-direction: column;
        width: max-content;
    }
    
    .header {
      border-bottom: 2px solid var(--blue);
      text-align: center;
      padding: 10px;
      padding-bottom: 2px;
    }

    .textArea{
      padding: 10px;
      padding-top: 5px;
      overflow-y: auto;
      scrollbar-width: thin;
      scrollbar-color: var(--blue) white;
    }

    .textArea::-webkit-scrollbar {
      width: 3px;
      height: auto;
    }
    .textArea::-webkit-scrollbar-thumb{
      background-color: var(--blue);
      border-radius: 5px;
    }
    .textArea::-webkit-scrollbar-track  {
    background-color: white;
}
</style>

<div class="column">
  <div class="header">
    {name}
  </div>
  <div class="textArea">
    {#each values as name}
      <div>{name}</div>
    {/each}
  </div>
</div>
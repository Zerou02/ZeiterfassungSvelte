<script lang="ts">
  import Background from "./Background.svelte";
  import NavBar from "./NavBar.svelte";
  import Table from "./Table.svelte";
</script>

<Background />
<div style="display: flex; flex-direction: column; gap: 50px ">
  <NavBar />
  <div style="display: flex; justify-content: center;">
    <Table />
  </div>
</div>

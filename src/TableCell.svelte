<script lang="ts">
  export let val: string;
</script>

<div class="table_cell">
  <p>{val}</p>
</div>

<style>
  p {
    color: white;
    text-align: center;
  }
  .table_cell {
    border: 1px solid rgb(87, 130, 218);
    background: rgb(4, 64, 155);
    height: 50px;
  }
</style>

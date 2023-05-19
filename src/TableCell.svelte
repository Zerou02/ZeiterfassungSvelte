<script lang="ts">
  export let val: string;
  export let isHeader: boolean;
  export let rightmost: boolean;
</script>

<div
  class={isHeader ? "header_cell" : "content_cell"}
  style={!rightmost && "border-right:none"}
>
  <p>{val}</p>
</div>

<style>
  p {
    color: white;
    text-align: center;
  }
  .content_cell {
    border: 1px solid #b46415;
    border-top: none;
    background: rgb(4, 64, 155);
    height: 50px;
    width: 100px;
  }
  .header_cell {
    border: 1px solid rgb(87, 130, 218);
    min-width: 100px;
    background: linear-gradient(rgb(46, 79, 143), rgb(4, 4, 155));
  }
</style>

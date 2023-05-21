<script lang="ts">
  export let val: string;
  export let isHeader: boolean;
  export let rightmost: boolean;
  export let style: string = "";
  export let textSize: "large" | "medium";
</script>

<div
  class={(isHeader ? "header_cell" : "content_cell") + " cell"}
  style={`font-size:${textSize === "large" ? "33" : "25"}px;` +
    (!rightmost ? "border-right:none;" : "") +
    style}
>
  <p>
    {val}
  </p>
</div>

<style>
  p {
    color: white;
    margin: 0;
    text-align: center;
  }
  .content_cell {
    border: 1px solid #b46415;
    border-top: none;
    background: rgb(4, 64, 155);
  }
  .header_cell {
    border: 1px solid rgb(87, 130, 218);
    background: linear-gradient(rgb(46, 79, 143), rgb(4, 4, 155));
  }
  .cell {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 50px;
  }
</style>

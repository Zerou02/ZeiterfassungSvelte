<script lang="ts">
  import { onMount } from "svelte";
  import { getBallAtPos, getRandomBall } from "./utils";
  import { screenSize, setScreenSize } from "./globals";
  import type { Ball } from "./Ball";
  let bgEl: HTMLDivElement;
  let canvas: HTMLCanvasElement;
  let ctx: CanvasRenderingContext2D;

  let ballList: Ball[] = [];

  const initVars = () => {
    canvas.width = bgEl.clientWidth;
    canvas.height = bgEl.clientHeight;
    setScreenSize(bgEl.clientWidth, bgEl.clientHeight);
    ctx.fillStyle = "white";
  };

  onMount(() => {
    ctx = canvas.getContext("2d");
    initVars();

    window.addEventListener("resize", (e) => {
      initVars();
    });
    window.addEventListener("mousedown", (e) => {
      ballList.push(getBallAtPos(e.x, e.y));
    });

    while (ballList.length < 20) {
      ballList.push(getRandomBall());
    }

    setInterval(() => {
      ctx.clearRect(0, 0, screenSize.x, screenSize.y);

      ballList.forEach((x) => {
        x.move();
        x.draw(ctx);
      });

      ballList = ballList.filter((x) => x.toDestroy === false);

      while (ballList.length < 20) {
        ballList.push(getRandomBall());
      }
    }, 1000 / 60);
  });
</script>

<div id="bg" bind:this={bgEl}>
  <canvas bind:this={canvas} />
</div>

<style>
  #bg {
    background-color: #132851;
    width: 100%;
    height: 100%;
    position: absolute;
    z-index: -1;
  }
</style>

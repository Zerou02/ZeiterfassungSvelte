<script lang="ts">
  import { onMount } from "svelte";
  import { getBallAtPos, getRandomBall, normalizeVector } from "./utils";
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

  const spawnBall = () => {
    let ball = getRandomBall();
    let isColliding = false;
    ballList.forEach((x) => {
      console.log("AA");

      if (x.isColliding(ball)) isColliding = true;
    });
    if (!isColliding) {
      ballList.push(ball);
    }
  };
  let startPos: Vector2;
  let endPos: Vector2;

  const spawnBallOnMouseUp = () => {
    let dir: Vector2 = { x: endPos.x - startPos.x, y: endPos.y - startPos.y };
    let ball = getBallAtPos(endPos.x, endPos.y);
    ball.direction = normalizeVector(dir);
    ballList.push(ball);
  };

  onMount(() => {
    ctx = canvas.getContext("2d");
    initVars();

    window.addEventListener("resize", (e) => {
      initVars();
    });
    window.addEventListener("mousedown", (e) => {
      startPos = { x: e.x, y: e.x };
    });
    window.addEventListener("mouseup", (e) => {
      endPos = { x: e.x, y: e.y };
      spawnBallOnMouseUp();
      console.log("a");
    });

    while (ballList.length < 20) {
      spawnBall();
    }

    setInterval(() => {
      ballList.forEach((x, i1) => {
        ballList.forEach((y, i2) => {
          if (i1 !== i2) {
            y.handleCollision(x);
          }
        });
      });
      ctx.clearRect(0, 0, screenSize.x, screenSize.y);

      ballList.forEach((x) => {
        x.move();
        x.draw(ctx);
        x.alreadyCollided = false;
      });

      ballList = ballList.filter((x) => x.toDestroy === false);

      while (ballList.length < 20) {
        spawnBall();
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

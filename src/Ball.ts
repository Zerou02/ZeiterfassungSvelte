import { screenSize } from "./globals";

export class Ball {
  x: number;
  y: number;
  radius: number;
  velocity: number;
  direction: Vector2;

  toDestroy: boolean;

  constructor(
    x: number,
    y: number,
    radius: number,
    velocity: number,
    direction: Vector2
  ) {
    this.x = x;
    this.y = y;
    this.radius = radius;
    this.velocity = velocity;
    this.direction = direction;
    this.toDestroy = false;
  }

  draw(ctx: CanvasRenderingContext2D) {
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.radius - 1, 0, 360);
    ctx.fill();
    ctx.arc(this.x, this.y, this.radius, 0, 360);
    ctx.stroke();
  }

  move() {
    this.x += this.velocity * this.direction.x;
    this.y += this.velocity * this.direction.y;
    if (
      this.x - this.radius > screenSize.x ||
      this.x - this.radius < 0 ||
      this.y - this.radius > screenSize.y ||
      this.y - this.radius < 0
    ) {
      this.toDestroy = true;
    }
  }
}

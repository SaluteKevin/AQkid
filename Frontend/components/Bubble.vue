<template>
<div class="bubble">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <img src="https://static.thairath.co.th/media/dFQROr7oWzulq5FZYANuEZlRY89MbBZGbB03TL7pGDPeb11CkdQJhamTfLVYfEGR0DP.webp" alt="">
</div>
</template>

<style>
.bubble {
    position: absolute;
    widows: 500px;
    height: 200px;
    border-radius: 50%;
    box-shadow: inset 0 0 25px rgba(255, 255, 255, 0.25);
    animation: animate 8s ease-in-out infinite;
 
}

.bubble img {
    position: absolute;
    height: 80%;
    width: 80%;
    border-radius: 50%;
    box-shadow: none;
    z-index: -1;
    
}
@keyframes animate {

    0% , 100%{
        transform: translateY(-20px);
    }

    50% {
        transform: translateY(20px);
    }
    
    
}

.bubble span {
    position: absolute;
    border-radius: 50%;
    z-index: 1;
}

.bubble span:nth-child(1) {
    inset: 10px;
    border-left: 15px solid #0fb4ff;
    filter: blur(8px);
    
}

.bubble span:nth-child(2) {
    inset: 10px;
    border-right: 15px solid #ff4484;
    filter: blur(8px);
}
.bubble span:nth-child(3) {
    inset: 20px;
    border-top: 15px solid #ffeb3b;
    filter: blur(8px);
}
.bubble span:nth-child(4) {
    inset: 30px;
    border-left: 15px solid #ff4484;
    filter: blur(8px);
}
.bubble span:nth-child(5) {
    inset: 10px;
    border-right: 10px solid #ffff;
    filter: blur(8px);
    transform: rotate(330deg);
}


</style>
<template>
    <div class="clouds">
            <img src="https://media.discordapp.net/attachments/1076489187638915133/1168215920800444466/cloud1.png?ex=6550f4db&is=653e7fdb&hm=3a316a29337c6b55adc3f4bbba16bf977f0f62af9bc73be7bc4cf6feca17fe03&=&width=2160&height=646" style="--i:1;" >
            <img src="https://media.discordapp.net/attachments/1076489187638915133/1168215921156968588/cloud2.png?ex=6550f4dc&is=653e7fdc&hm=c7b511e78696f32ebec216609d1091f34ab07fa6dd82905ff28dc155762dea26&=&width=2160&height=478" style="--i:2;" >
            <img src="https://media.discordapp.net/attachments/1076489187638915133/1168215921521868851/cloud3.png?ex=6550f4dc&is=653e7fdc&hm=54d79b900c699d5c59c769ecd6a79b4541b31b639803b5120c4914f894a58792&=&width=1900&height=1068" style="--i:3;" >
            <img src="https://media.discordapp.net/attachments/1076489187638915133/1168215921941295174/cloud4.png?ex=6550f4dc&is=653e7fdc&hm=10a365e6fcc676ceb4ff3bbad9abe5999ad4bd799315247a1d12fe7b169187ba&=&width=2160&height=738" style="--i:4;" >
            <img src="https://media.discordapp.net/attachments/1076489187638915133/1168215922356539413/cloud5.png?ex=6550f4dc&is=653e7fdc&hm=6cd49dbaa3b3b82472636c87a351753f17b11ec74b5c54f79cf33718785a0913&=&width=2160&height=860" style="--i:5;" >
    </div>
    
        
    
    <section>
        <h2>saas</h2>
    </section>


</template>

<script>
definePageMeta({layout: 'teacher'})

</script>



<style scoped>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
    background-color: black;
}

.banner {
    position: relative;
    widows: 100%;
    height: 100vh;
    background-color: blue;

}

.clouds {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    overflow: hidden;
}
.clouds img {
    position: absolute;
    bottom: 0;
}

</style>
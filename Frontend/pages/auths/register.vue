<template>
    <div class="h-screen justify-end place-item-center flex">
        <img class="w-1/2 object-cover" src="https://media.discordapp.net/attachments/1077532767052628008/1160566075277201458/325391955_957174475648899_6145813447620796700_n.png?ex=65352062&is=6522ab62&hm=c251cd1182ab5d70773a01685bfde627a07f42d831fbc6c99d38f987a85f95f8&=&width=1440&height=1068">
        <div class="bg-native w-full rounded-l-xl p-16 shadow-2xl">
            <form @submit.prevent="handleRegister()">
            <h1 class="text-4xl decoration-indigo-500 text-center mt-12 text-gray-800 font-semibold">Sign up</h1>
                    <label for="username" class="flex">Username <span class="text-red-500 mt-1 ml-2">  ***</span></label>
                    <input 
                        type="text"
                        class="block border border-grey-light w-full p-3 rounded  "
                        name="username"
                        placeholder="Username" id="username"/>

                    <label for="email" class="flex mt-4">Email</label>
                    <input 
                        type="email"
                        class="block border border-grey-light w-full p-3 rounded"
                        name="email"
                        placeholder="Email (Optional)" 
                        id="email"/>

                    <label for="password" class="flex mt-4">Username <span class="text-red-500 mt-1 ml-2">  ***</span></label>
                    <input 
                        type="text"
                        class="block border border-grey-light w-full p-3 rounded"
                        name="password"
                        placeholder="Password" 
                        id="password"/>
                    
                    <label for="confirm_password" class="flex mt-4">Username <span class="text-red-500 mt-1 ml-2">  ***</span></label>
                    <input 
                        type="text"
                        class="block border border-grey-light w-full p-3 rounded"
                        name="confirm_password"
                        placeholder="Confirm Password" 
                        id="confirm_password"/>

                    <button
                        type="submit"
                        class="bg-black mt-8
                               shadow-inner 
                               hover:shadow-xl duration-300 hover:bg-white hover:text-indigo-600 w-full text-center py-3 rounded text-white my-1"
                    >Create Account</button>

                    <div class="text-grey-dark">
                    Already Sign Up? 
                    <NuxtLink class="no-underline border-b border-blue text-indigo-600" to="/auths/login">
                        Log in
                    </NuxtLink>

                </div>
            </form>
        </div>
        
    </div>
</template>

<style>
::placeholder {
  color: red;
  opacity: 1; /* Firefox */
}
</style>

<script setup lang="ts">
definePageMeta({layout: false})


function handleRegister() {
console.log("assa")

}
</script>
<template>

<header>
    <nav class="z-10 w-full bg-gray-100 px-16 shadow-md">
        <div>
            <div class="flex flex-wrap items-center justify-between gap-6 py-2">
                <div class="flex w-full justify-between md:px-0 lg:w-max">

                    <NuxtLink class="flex items-center space-x-2" to="/">
                        
                        <div aria-hidden="true" class="flex space-x-1">
                            <img src="/images/AQKids_logo.png" class="h-12">
                        </div>
                        <span class="text-4xl font-bold text-cyan-900">AQKids</span>
                    </NuxtLink>
                    
                </div>
                
                <div class="space-x-4">
                    <NuxtLink class="py-2 px-4 text-white font-semibold rounded-md bg-cyan-900 hover:bg-cyan-950 duration-200" to="/auths/login">
                    Login
                    </NuxtLink>
                    <NuxtLink class="py-2 px-4 text-white font-semibold rounded-md bg-orange-500 hover:bg-orange-700 duration-200" to="/auths/register">
                    Register
                    </NuxtLink>
                    
                </div>
                
            </div>
        </div>
    </nav>
</header>

</template>
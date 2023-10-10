<template>
    <div class = "fixed w-full z-30 flex bg-orange-500 p-2 items-center justify-center h-16 px-10">
        <div ref="logo" class = "logo ml-12 dark:text-white  transform ease-in-out duration-500 flex-none h-full flex items-center justify-center">
            STAFF MANAGER
        </div>
        <!-- SPACER -->
        <div class = "grow h-full flex items-center justify-center"></div>
        <div class = "flex-none h-full text-center flex items-center justify-center">
            
                <div class = "flex space-x-3 items-center px-3">
                    <div class = "flex-none flex justify-center">
                    <div class="w-8 h-8 flex ">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShta_GXR2xdnsxSzj_GTcJHcNykjVKrCBrZ9qouUl0usuJWG2Rpr_PbTDu3sA9auNUH64&usqp=CAU" alt="profile" class="shadow rounded-full object-cover" />
                    </div>
                    </div>

                    <div class = "hidden md:block text-sm md:text-md text-black dark:text-white">John Doe</div>
                </div>

                <div v-click-outside="clickOutside" class="relative">
                        <button v-on:click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-gray-200  rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                        <span>Dropdown</span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <div v-if="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                        <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Link #1</a>
                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Link #2</a>
                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Link #3</a>
                        </div>
                        </div>
                    </div>    

                
                
        </div>
    </div>
    <aside v-click-outside="closeNav" ref="sidebar" class = "w-60 -translate-x-48 fixed transition transform ease-in-out duration-1000 z-50 flex h-screen bg-[#1E293B] ">
        <!-- open sidebar button -->
        <div ref="maxToolbar" class = "max-toolbar translate-x-24 scale-x-0 w-full -right-6 transition transform ease-in duration-300 flex items-center justify-between border-4 border-gray-950 bg-[#1E293B]  absolute top-5 rounded-full h-12">            
            <div  class = "flex items-center space-x-3 group bg-gradient-to-r from-amber-500 via-orange-500 to-orange-700  pl-14 pr-4 py-1 rounded-full text-white h-full w-full font-semibold">
                <div class= "transform ease-in-out duration-300 mr-12">
                    AQKIDS
                </div>
            </div>
        </div>
        <div  @click="openNav()" class = "cursor-pointer -right-6 transition transform ease-in-out duration-500 flex border-4 border-gray-950 bg-[#1E293B] hover:bg-white absolute top-2 rounded-full text-white hover:rotate-45">            
            <img src="/images/AQKids_logo.png" class="w-16 h-16">
        </div>
        <!-- MAX SIDEBAR-->
        <div ref="maxSidebar" class= "max hidden text-white mt-24 flex-col space-y-4 w-full h-[calc(100vh)]">
            <div class =  "hover:ml-4 w-full text-white hover:bg-orange-500 py-1 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
                <svg width="25px" height="25px" viewBox="0 -0.5 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>home [#1391]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-419.000000, -720.000000)" fill="#ffffff"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M379.79996,578 L376.649968,578 L376.649968,574 L370.349983,574 L370.349983,578 L367.19999,578 L367.19999,568.813 L373.489475,562.823 L379.79996,568.832 L379.79996,578 Z M381.899955,568.004 L381.899955,568 L381.899955,568 L373.502075,560 L363,569.992 L364.481546,571.406 L365.099995,570.813 L365.099995,580 L372.449978,580 L372.449978,576 L374.549973,576 L374.549973,580 L381.899955,580 L381.899955,579.997 L381.899955,570.832 L382.514204,571.416 L384.001,570.002 L381.899955,568.004 Z" id="home-[#1391]"> </path> </g> </g> </g> </g></svg>                <div>
                    Home
                </div>
            </div>
            <div class =  "hover:ml-4 w-full text-white hover:bg-orange-500 py-1 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
                <svg width="25px" height="25px" fill="#ffffff" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" ><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M24.98 30.009h-23v-25h14.050l2.022-1.948-0.052-0.052h-16.020c-1.105 0-2 0.896-2 2v25c0 1.105 0.895 2 2 2h23c1.105 0 2-0.895 2-2v-14.646l-2 1.909v12.736zM30.445 1.295c-0.902-0.865-1.898-1.304-2.961-1.304-1.663 0-2.876 1.074-3.206 1.403-0.468 0.462-13.724 13.699-13.724 13.699-0.104 0.106-0.18 0.235-0.219 0.38-0.359 1.326-2.159 7.218-2.176 7.277-0.093 0.302-0.010 0.631 0.213 0.851 0.159 0.16 0.373 0.245 0.591 0.245 0.086 0 0.172-0.012 0.257-0.039 0.061-0.020 6.141-1.986 7.141-2.285 0.132-0.039 0.252-0.11 0.351-0.207 0.631-0.623 12.816-12.618 13.802-13.637 1.020-1.052 1.526-2.146 1.507-3.253-0.019-1.094-0.55-2.147-1.575-3.129zM29.076 6.285c-0.556 0.574-4.914 4.88-12.952 12.798l-0.615 0.607c-0.921 0.285-3.128 0.994-4.796 1.532 0.537-1.773 1.181-3.916 1.469-4.929 1.717-1.715 13.075-13.055 13.506-13.48 0.084-0.084 0.851-0.821 1.795-0.821 0.536 0 1.053 0.244 1.577 0.748 0.627 0.602 0.95 1.179 0.959 1.72 0.010 0.556-0.308 1.171-0.943 1.827z"></path> </g></svg>            <div>
                    Request
                </div>
            </div>
            <div class =  "hover:ml-4 w-full text-white hover:bg-orange-500 py-1 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
            <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10.9391 5.49826C11.0902 5.1126 10.9001 4.67744 10.5144 4.5263C10.1288 4.37516 9.69362 4.56528 9.54248 4.95093L10.9391 5.49826ZM11.8058 9.56459L12.1694 8.90867L12.1687 8.90826L11.8058 9.56459ZM13.502 10.7516C13.9162 10.7509 14.2514 10.4146 14.2508 10.0004C14.2501 9.58617 13.9138 9.25093 13.4996 9.25159L13.502 10.7516ZM10.2408 5.22459L10.0531 4.49845L10.0517 4.49883L10.2408 5.22459ZM18.7648 10.1936L18.0404 10.3881C18.1005 10.6118 18.2606 10.7952 18.4742 10.885C18.6877 10.9748 18.9308 10.9608 19.1327 10.8472L18.7648 10.1936ZM20.6096 10.4908L20.0551 10.9958V10.9958L20.6096 10.4908ZM20.7332 12.3554L21.3496 12.7827V12.7827L20.7332 12.3554ZM18.9438 12.8936L19.2222 12.1972C19.0067 12.111 18.7635 12.1295 18.5635 12.2471C18.3635 12.3648 18.2292 12.5683 18.1998 12.7985L18.9438 12.8936ZM5.05677 12.8936L5.80072 12.7985C5.7713 12.5683 5.63701 12.3648 5.43702 12.2471C5.23702 12.1295 4.99384 12.111 4.77839 12.1972L5.05677 12.8936ZM3.2673 12.3554L2.65095 12.7827L2.65095 12.7827L3.2673 12.3554ZM3.39092 10.4908L3.94546 10.9958L3.94546 10.9958L3.39092 10.4908ZM5.23577 10.1936L4.86789 10.8472C5.06979 10.9608 5.31288 10.9748 5.52645 10.885C5.74003 10.7952 5.90011 10.6117 5.96015 10.388L5.23577 10.1936ZM9.54248 4.95093C8.76469 6.93559 9.57741 9.18941 11.4428 10.2209L12.1687 8.90826C10.9617 8.2408 10.4358 6.78245 10.9391 5.49826L9.54248 4.95093ZM11.4421 10.2205C12.0723 10.57 12.7813 10.7528 13.502 10.7516L13.4996 9.25159C13.0342 9.25234 12.5764 9.13431 12.1694 8.90867L11.4421 10.2205ZM10.4284 5.95074C13.7534 5.09153 17.1498 7.07144 18.0404 10.3881L19.4891 9.99908C18.385 5.88768 14.1748 3.43336 10.0531 4.49845L10.4284 5.95074ZM19.1327 10.8472C19.4372 10.6757 19.8198 10.7374 20.0551 10.9958L21.1642 9.98589C20.4583 9.21068 19.3105 9.02575 18.3969 9.54002L19.1327 10.8472ZM20.0551 10.9958C20.2904 11.2542 20.316 11.6409 20.1169 11.9281L21.3496 12.7827C21.947 11.9211 21.8701 10.7611 21.1642 9.98589L20.0551 10.9958ZM20.1169 11.9281C19.9178 12.2153 19.5467 12.3269 19.2222 12.1972L18.6654 13.59C19.6389 13.9792 20.7522 13.6443 21.3496 12.7827L20.1169 11.9281ZM18.1998 12.7985C17.801 15.9185 15.1457 18.256 12.0003 18.256V19.756C15.9006 19.756 19.1932 16.8575 19.6877 12.9887L18.1998 12.7985ZM12.0003 18.256C8.85488 18.256 6.19955 15.9185 5.80072 12.7985L4.31283 12.9887C4.80737 16.8575 8.09999 19.756 12.0003 19.756V18.256ZM4.77839 12.1972C4.45388 12.3269 4.08278 12.2153 3.88366 11.9281L2.65095 12.7827C3.24832 13.6443 4.36161 13.9792 5.33515 13.59L4.77839 12.1972ZM3.88366 11.9281C3.68453 11.6409 3.71017 11.2542 3.94546 10.9958L2.83637 9.98589C2.13048 10.7611 2.05358 11.9211 2.65095 12.7827L3.88366 11.9281ZM3.94546 10.9958C4.18076 10.7374 4.56334 10.6757 4.86789 10.8472L5.60365 9.54002C4.69 9.02575 3.54225 9.21068 2.83637 9.98589L3.94546 10.9958ZM5.96015 10.388C6.5438 8.21268 8.25047 6.51828 10.4299 5.95036L10.0517 4.49883C7.35024 5.20278 5.23482 7.30298 4.51139 9.99924L5.96015 10.388Z" fill="#ffffff"></path> <path d="M9.00073 12.5016C8.72503 12.5016 8.50073 12.2773 8.50073 12.0016C8.50073 11.7259 8.72503 11.5016 9.00073 11.5016C9.27643 11.5016 9.50073 11.7259 9.50073 12.0016C9.50073 12.2773 9.27643 12.5016 9.00073 12.5016Z" fill="#ffffff"></path> <path d="M9.00073 13.0016C8.44845 13.0016 8.00073 12.5539 8.00073 12.0016C8.00073 11.4493 8.44845 11.0016 9.00073 11.0016C9.55301 11.0016 10.0007 11.4493 10.0007 12.0016C10.0007 12.5539 9.55301 13.0016 9.00073 13.0016Z" fill="#ffffff"></path> <path d="M15.0007 12.5016C14.725 12.5016 14.5007 12.2773 14.5007 12.0016C14.5007 11.7259 14.725 11.5016 15.0007 11.5016C15.2764 11.5016 15.5007 11.7259 15.5007 12.0016C15.5007 12.2773 15.2764 12.5016 15.0007 12.5016Z" fill="#ffffff"></path> <path d="M15.0007 13.0016C14.4485 13.0016 14.0007 12.5539 14.0007 12.0016C14.0007 11.4493 14.4485 11.0016 15.0007 11.0016C15.553 11.0016 16.0007 11.4493 16.0007 12.0016C16.0007 12.5539 15.553 13.0016 15.0007 13.0016Z" fill="#ffffff"></path> </g></svg>                <div>
                    Student
                </div>
            </div>
            <div class =  "hover:ml-4 w-full text-white hover:bg-orange-500 py-1 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
                <svg fill="#ffffff" width="25px" height="25px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 365.702 365.702" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M99.415,163.15c-20.713,0-37.564-16.851-37.564-37.564c0-20.713,16.852-37.564,37.564-37.564 c20.713,0,37.564,16.852,37.564,37.564C136.979,146.299,120.128,163.15,99.415,163.15z M99.415,103.021 c-12.442,0-22.564,10.122-22.564,22.564s10.122,22.564,22.564,22.564c12.442,0,22.564-10.122,22.564-22.564 S111.857,103.021,99.415,103.021z"></path> </g> <path d="M358.202,268.162h-9.804V53.142c0-4.143-3.358-7.5-7.5-7.5H24.803c-4.142,0-7.5,3.357-7.5,7.5v215.02H7.5 c-4.143,0-7.5,3.358-7.5,7.5v21.402c0,4.143,3.357,7.5,7.5,7.5h37.323v7.996c0,4.143,3.357,7.5,7.5,7.5h91.805 c4.143,0,7.5-3.357,7.5-7.5v-7.996h206.574c4.143,0,7.5-3.357,7.5-7.5v-21.402C365.702,271.519,362.345,268.162,358.202,268.162z M44.823,289.564H15v-6.402h29.823V289.564z M44.823,188.771v79.391H32.303V60.642h301.096v207.52H151.628v-38.525l28.995,25.609 c2.513,1.964,4.692,1.893,5.113,1.878c2.035-0.036,3.968-0.897,5.354-2.387l59.896-64.362c3.429-3.647,5.194-8.393,4.972-13.364 c-0.182-4.068-1.703-7.869-4.304-10.968l43.962-47.176c2.823-3.03,2.656-7.776-0.374-10.601c-3.03-2.823-7.776-2.654-10.601,0.374 l-43.914,47.125c-3.11-2.292-6.887-3.526-10.848-3.438c-4.962,0.081-9.763,2.21-13.154,5.821l-32.974,35.336 c0,0-25.232-23.617-25.519-23.817c-4.262-3.347-9.564-5.184-14.996-5.184H69.108C55.718,164.484,44.823,175.379,44.823,188.771z M239.604,175.096c0.05,0.047,0.101,0.093,0.151,0.139c0.954,0.849,1.189,1.798,1.218,2.445c0.04,0.891-0.285,1.75-0.954,2.461 l-5.848,6.314l-12.493-11.711l5.964-6.308c0.889-0.946,1.938-1.103,2.483-1.111c0.454,0.002,1.341,0.082,2.027,0.767 c0.053,0.052,0.106,0.104,0.161,0.154L239.604,175.096z M149.093,207.384c-2.21-1.954-5.36-2.427-8.048-1.216 c-2.688,1.213-4.417,3.888-4.417,6.837v92.055H59.823V188.771c0-5.121,4.165-9.287,9.285-9.287h74.129 c2.756,0,4.73,1.151,5.901,2.116c0.003,0.003,0.006,0.005,0.009,0.008l29.849,27.979c1.456,1.366,3.396,2.105,5.393,2.023 c1.995-0.069,3.88-0.933,5.236-2.396l21.801-23.52l12.537,11.752l-38.876,41.73L149.093,207.384z M350.702,289.564H151.628v-6.402 h199.074V289.564z"></path> </g> </g> </g></svg>                     
                <div>
                    Teacher
                </div>
            </div>
        </div>
        <!-- MINI SIDEBAR-->
        <div ref="miniSidebar" class= "mini mt-20 flex flex-col space-y-2 w-full h-[calc(100vh)]">
            <div class= "hover:ml-4 justify-end pr-5 text-white hover:bg-orange-500 w-full p-3 rounded-full transform ease-in-out duration-300 flex">
                <svg width="20px" height="20px" viewBox="0 -0.5 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>home [#1391]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-419.000000, -720.000000)" fill="#ffffff"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M379.79996,578 L376.649968,578 L376.649968,574 L370.349983,574 L370.349983,578 L367.19999,578 L367.19999,568.813 L373.489475,562.823 L379.79996,568.832 L379.79996,578 Z M381.899955,568.004 L381.899955,568 L381.899955,568 L373.502075,560 L363,569.992 L364.481546,571.406 L365.099995,570.813 L365.099995,580 L372.449978,580 L372.449978,576 L374.549973,576 L374.549973,580 L381.899955,580 L381.899955,579.997 L381.899955,570.832 L382.514204,571.416 L384.001,570.002 L381.899955,568.004 Z" id="home-[#1391]"> </path> </g> </g> </g> </g></svg>                
            </div>
            <div class= "hover:ml-4 justify-end pr-5 text-white hover:bg-orange-500 w-full p-3 rounded-full transform ease-in-out duration-300 flex">
                <svg width="20px" height="20px" fill="#ffffff" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" ><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M24.98 30.009h-23v-25h14.050l2.022-1.948-0.052-0.052h-16.020c-1.105 0-2 0.896-2 2v25c0 1.105 0.895 2 2 2h23c1.105 0 2-0.895 2-2v-14.646l-2 1.909v12.736zM30.445 1.295c-0.902-0.865-1.898-1.304-2.961-1.304-1.663 0-2.876 1.074-3.206 1.403-0.468 0.462-13.724 13.699-13.724 13.699-0.104 0.106-0.18 0.235-0.219 0.38-0.359 1.326-2.159 7.218-2.176 7.277-0.093 0.302-0.010 0.631 0.213 0.851 0.159 0.16 0.373 0.245 0.591 0.245 0.086 0 0.172-0.012 0.257-0.039 0.061-0.020 6.141-1.986 7.141-2.285 0.132-0.039 0.252-0.11 0.351-0.207 0.631-0.623 12.816-12.618 13.802-13.637 1.020-1.052 1.526-2.146 1.507-3.253-0.019-1.094-0.55-2.147-1.575-3.129zM29.076 6.285c-0.556 0.574-4.914 4.88-12.952 12.798l-0.615 0.607c-0.921 0.285-3.128 0.994-4.796 1.532 0.537-1.773 1.181-3.916 1.469-4.929 1.717-1.715 13.075-13.055 13.506-13.48 0.084-0.084 0.851-0.821 1.795-0.821 0.536 0 1.053 0.244 1.577 0.748 0.627 0.602 0.95 1.179 0.959 1.72 0.010 0.556-0.308 1.171-0.943 1.827z"></path> </g></svg>               
            </div>
            <div class= "hover:ml-4 justify-end pr-5 text-white hover:bg-orange-500 w-full p-3 rounded-full transform ease-in-out duration-300 flex">
                <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10.9391 5.49826C11.0902 5.1126 10.9001 4.67744 10.5144 4.5263C10.1288 4.37516 9.69362 4.56528 9.54248 4.95093L10.9391 5.49826ZM11.8058 9.56459L12.1694 8.90867L12.1687 8.90826L11.8058 9.56459ZM13.502 10.7516C13.9162 10.7509 14.2514 10.4146 14.2508 10.0004C14.2501 9.58617 13.9138 9.25093 13.4996 9.25159L13.502 10.7516ZM10.2408 5.22459L10.0531 4.49845L10.0517 4.49883L10.2408 5.22459ZM18.7648 10.1936L18.0404 10.3881C18.1005 10.6118 18.2606 10.7952 18.4742 10.885C18.6877 10.9748 18.9308 10.9608 19.1327 10.8472L18.7648 10.1936ZM20.6096 10.4908L20.0551 10.9958V10.9958L20.6096 10.4908ZM20.7332 12.3554L21.3496 12.7827V12.7827L20.7332 12.3554ZM18.9438 12.8936L19.2222 12.1972C19.0067 12.111 18.7635 12.1295 18.5635 12.2471C18.3635 12.3648 18.2292 12.5683 18.1998 12.7985L18.9438 12.8936ZM5.05677 12.8936L5.80072 12.7985C5.7713 12.5683 5.63701 12.3648 5.43702 12.2471C5.23702 12.1295 4.99384 12.111 4.77839 12.1972L5.05677 12.8936ZM3.2673 12.3554L2.65095 12.7827L2.65095 12.7827L3.2673 12.3554ZM3.39092 10.4908L3.94546 10.9958L3.94546 10.9958L3.39092 10.4908ZM5.23577 10.1936L4.86789 10.8472C5.06979 10.9608 5.31288 10.9748 5.52645 10.885C5.74003 10.7952 5.90011 10.6117 5.96015 10.388L5.23577 10.1936ZM9.54248 4.95093C8.76469 6.93559 9.57741 9.18941 11.4428 10.2209L12.1687 8.90826C10.9617 8.2408 10.4358 6.78245 10.9391 5.49826L9.54248 4.95093ZM11.4421 10.2205C12.0723 10.57 12.7813 10.7528 13.502 10.7516L13.4996 9.25159C13.0342 9.25234 12.5764 9.13431 12.1694 8.90867L11.4421 10.2205ZM10.4284 5.95074C13.7534 5.09153 17.1498 7.07144 18.0404 10.3881L19.4891 9.99908C18.385 5.88768 14.1748 3.43336 10.0531 4.49845L10.4284 5.95074ZM19.1327 10.8472C19.4372 10.6757 19.8198 10.7374 20.0551 10.9958L21.1642 9.98589C20.4583 9.21068 19.3105 9.02575 18.3969 9.54002L19.1327 10.8472ZM20.0551 10.9958C20.2904 11.2542 20.316 11.6409 20.1169 11.9281L21.3496 12.7827C21.947 11.9211 21.8701 10.7611 21.1642 9.98589L20.0551 10.9958ZM20.1169 11.9281C19.9178 12.2153 19.5467 12.3269 19.2222 12.1972L18.6654 13.59C19.6389 13.9792 20.7522 13.6443 21.3496 12.7827L20.1169 11.9281ZM18.1998 12.7985C17.801 15.9185 15.1457 18.256 12.0003 18.256V19.756C15.9006 19.756 19.1932 16.8575 19.6877 12.9887L18.1998 12.7985ZM12.0003 18.256C8.85488 18.256 6.19955 15.9185 5.80072 12.7985L4.31283 12.9887C4.80737 16.8575 8.09999 19.756 12.0003 19.756V18.256ZM4.77839 12.1972C4.45388 12.3269 4.08278 12.2153 3.88366 11.9281L2.65095 12.7827C3.24832 13.6443 4.36161 13.9792 5.33515 13.59L4.77839 12.1972ZM3.88366 11.9281C3.68453 11.6409 3.71017 11.2542 3.94546 10.9958L2.83637 9.98589C2.13048 10.7611 2.05358 11.9211 2.65095 12.7827L3.88366 11.9281ZM3.94546 10.9958C4.18076 10.7374 4.56334 10.6757 4.86789 10.8472L5.60365 9.54002C4.69 9.02575 3.54225 9.21068 2.83637 9.98589L3.94546 10.9958ZM5.96015 10.388C6.5438 8.21268 8.25047 6.51828 10.4299 5.95036L10.0517 4.49883C7.35024 5.20278 5.23482 7.30298 4.51139 9.99924L5.96015 10.388Z" fill="#ffffff"></path> <path d="M9.00073 12.5016C8.72503 12.5016 8.50073 12.2773 8.50073 12.0016C8.50073 11.7259 8.72503 11.5016 9.00073 11.5016C9.27643 11.5016 9.50073 11.7259 9.50073 12.0016C9.50073 12.2773 9.27643 12.5016 9.00073 12.5016Z" fill="#ffffff"></path> <path d="M9.00073 13.0016C8.44845 13.0016 8.00073 12.5539 8.00073 12.0016C8.00073 11.4493 8.44845 11.0016 9.00073 11.0016C9.55301 11.0016 10.0007 11.4493 10.0007 12.0016C10.0007 12.5539 9.55301 13.0016 9.00073 13.0016Z" fill="#ffffff"></path> <path d="M15.0007 12.5016C14.725 12.5016 14.5007 12.2773 14.5007 12.0016C14.5007 11.7259 14.725 11.5016 15.0007 11.5016C15.2764 11.5016 15.5007 11.7259 15.5007 12.0016C15.5007 12.2773 15.2764 12.5016 15.0007 12.5016Z" fill="#ffffff"></path> <path d="M15.0007 13.0016C14.4485 13.0016 14.0007 12.5539 14.0007 12.0016C14.0007 11.4493 14.4485 11.0016 15.0007 11.0016C15.553 11.0016 16.0007 11.4493 16.0007 12.0016C16.0007 12.5539 15.553 13.0016 15.0007 13.0016Z" fill="#ffffff"></path> </g></svg>         
            </div>
            <div class= "hover:ml-4 justify-end pr-5 text-white hover:bg-orange-500 w-full p-3 rounded-full transform ease-in-out duration-300 flex">
                <svg fill="#ffffff" width="25px" height="25px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 365.702 365.702" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M99.415,163.15c-20.713,0-37.564-16.851-37.564-37.564c0-20.713,16.852-37.564,37.564-37.564 c20.713,0,37.564,16.852,37.564,37.564C136.979,146.299,120.128,163.15,99.415,163.15z M99.415,103.021 c-12.442,0-22.564,10.122-22.564,22.564s10.122,22.564,22.564,22.564c12.442,0,22.564-10.122,22.564-22.564 S111.857,103.021,99.415,103.021z"></path> </g> <path d="M358.202,268.162h-9.804V53.142c0-4.143-3.358-7.5-7.5-7.5H24.803c-4.142,0-7.5,3.357-7.5,7.5v215.02H7.5 c-4.143,0-7.5,3.358-7.5,7.5v21.402c0,4.143,3.357,7.5,7.5,7.5h37.323v7.996c0,4.143,3.357,7.5,7.5,7.5h91.805 c4.143,0,7.5-3.357,7.5-7.5v-7.996h206.574c4.143,0,7.5-3.357,7.5-7.5v-21.402C365.702,271.519,362.345,268.162,358.202,268.162z M44.823,289.564H15v-6.402h29.823V289.564z M44.823,188.771v79.391H32.303V60.642h301.096v207.52H151.628v-38.525l28.995,25.609 c2.513,1.964,4.692,1.893,5.113,1.878c2.035-0.036,3.968-0.897,5.354-2.387l59.896-64.362c3.429-3.647,5.194-8.393,4.972-13.364 c-0.182-4.068-1.703-7.869-4.304-10.968l43.962-47.176c2.823-3.03,2.656-7.776-0.374-10.601c-3.03-2.823-7.776-2.654-10.601,0.374 l-43.914,47.125c-3.11-2.292-6.887-3.526-10.848-3.438c-4.962,0.081-9.763,2.21-13.154,5.821l-32.974,35.336 c0,0-25.232-23.617-25.519-23.817c-4.262-3.347-9.564-5.184-14.996-5.184H69.108C55.718,164.484,44.823,175.379,44.823,188.771z M239.604,175.096c0.05,0.047,0.101,0.093,0.151,0.139c0.954,0.849,1.189,1.798,1.218,2.445c0.04,0.891-0.285,1.75-0.954,2.461 l-5.848,6.314l-12.493-11.711l5.964-6.308c0.889-0.946,1.938-1.103,2.483-1.111c0.454,0.002,1.341,0.082,2.027,0.767 c0.053,0.052,0.106,0.104,0.161,0.154L239.604,175.096z M149.093,207.384c-2.21-1.954-5.36-2.427-8.048-1.216 c-2.688,1.213-4.417,3.888-4.417,6.837v92.055H59.823V188.771c0-5.121,4.165-9.287,9.285-9.287h74.129 c2.756,0,4.73,1.151,5.901,2.116c0.003,0.003,0.006,0.005,0.009,0.008l29.849,27.979c1.456,1.366,3.396,2.105,5.393,2.023 c1.995-0.069,3.88-0.933,5.236-2.396l21.801-23.52l12.537,11.752l-38.876,41.73L149.093,207.384z M350.702,289.564H151.628v-6.402 h199.074V289.564z"></path> </g> </g> </g></svg>                     
            </div>
        </div>
        
    </aside>
    <!-- CONTENT -->
    <div ref="content" class = "content ml-12 transform ease-in-out duration-500 pt-16">
        <slot />
    </div>

</template>

<script setup lang="ts">



const sidebar = ref<HTMLElement | null>(null);
const maxSidebar = ref<HTMLElement | null>(null);
const miniSidebar = ref<HTMLElement | null>(null);
const maxToolbar = ref<HTMLElement | null>(null);
const logo = ref<HTMLElement | null>(null);
const content = ref<HTMLElement | null>(null);
const open = ref(false);

const clickOutside = () => {
  open.value = false;
};

const closeNav = () =>{
    sidebar.value?.classList.add('-translate-x-48');
    sidebar.value?.classList.remove('translate-x-none');
    maxSidebar.value?.classList.add('hidden');
    maxSidebar.value?.classList.remove('flex');
    miniSidebar.value?.classList.add('flex');
    miniSidebar.value?.classList.remove('hidden');
    maxToolbar.value?.classList.add('translate-x-24', 'scale-x-0');
    maxToolbar.value?.classList.remove('translate-x-0');
    logo.value?.classList.add('ml-12');
    content.value?.classList.remove('ml-12', 'md:ml-60');
    content.value?.classList.add('ml-12');
}

const openNav = () => {
  if (sidebar.value?.classList.contains('-translate-x-48')) {
    // max sidebar
    sidebar.value?.classList.remove('-translate-x-48');
    sidebar.value?.classList.add('translate-x-none');
    maxSidebar.value?.classList.remove('hidden');
    maxSidebar.value?.classList.add('flex');
    miniSidebar.value?.classList.remove('flex');
    miniSidebar.value?.classList.add('hidden');
    maxToolbar.value?.classList.add('translate-x-0');
    maxToolbar.value?.classList.remove('translate-x-24', 'scale-x-0');
    logo.value?.classList.remove('ml-12');
    content.value?.classList.remove('ml-12');
    content.value?.classList.add('ml-12', 'md:ml-60');
  } else {
    // mini sidebar
    sidebar.value?.classList.add('-translate-x-48');
    sidebar.value?.classList.remove('translate-x-none');
    maxSidebar.value?.classList.add('hidden');
    maxSidebar.value?.classList.remove('flex');
    miniSidebar.value?.classList.add('flex');
    miniSidebar.value?.classList.remove('hidden');
    maxToolbar.value?.classList.add('translate-x-24', 'scale-x-0');
    maxToolbar.value?.classList.remove('translate-x-0');
    logo.value?.classList.add('ml-12');
    content.value?.classList.remove('ml-12', 'md:ml-60');
    content.value?.classList.add('ml-12');
  }
};
        
</script>
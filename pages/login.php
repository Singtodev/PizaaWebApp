<!DOCTYPE html>
<html lang="en">
<?php
    require_once('../utils/head.php')
?>
<body>
    <div class="relative">
        <div class="bg-white h-screen w-screen lg:hidden">
            <div class="relative h-[85vh] flex flex-col gap-y-3">
                <div class="logo_section h-[200px] flex items-end justify-center">
                    <div class="logo w-[100px] h-[100px] rounded-xl  mx-5 bg-cover bg-center object-cover bg-[url(https://img.freepik.com/premium-vector/pizza-logo-design_9845-319.jpg?w=826)]"></div>
                </div>
                <div class="logo_form h-[200px] px-8 py-2 flex flex-col gap-y-3">
                        <div class="group_input flex flex-col gap-y-2">
                            <span>Email</span>
                            <input 
                                class="bg-gray-300 py-2 rounded-lg px-4 outline-none" 
                                type="text"
                                name="email"
                                placeholder="Enter your email"
                             />
                        </div>
                        <div class="group_input flex flex-col gap-y-2">
                            <span>Password</span>
                            <input 
                                class="bg-gray-300 py-2 rounded-lg px-4 outline-none" 
                                type="text"
                                name="password"
                                placeholder="Enter your password"
                             />
                        </div>
                        <div class="group_input flex flex-row justify-end gap-y-2">
                            <span>forgot password</span>
                        </div>
                        <div class="group_input flex flex-row justify-center">
                            <div class="py-2 px-10 rounded-2xl text-white hover:bg-[#ff0000] bg-[#FF7272]">Login</div>
                        </div>
                </div>
            </div>
            <div class="relative h-[15vh]">
                <div class="w-full h-auto flex flex-row gap-x-2 justify-center">
                    <p>your aren't have account </p>
                    <a href="register">
                        <span class="text-[#FF0000]">register</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
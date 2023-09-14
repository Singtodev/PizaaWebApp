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
                            <span>Full Name</span>
                            <input 
                                class="bg-gray-300 py-2 rounded-lg px-4 outline-none" 
                                type="text"
                                name="full_name"
                                placeholder="Enter your Full Name"
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
                        <div class="group_input flex flex-col gap-y-2">
                            <span>Confirm Password</span>
                            <input 
                                class="bg-gray-300 py-2 rounded-lg px-4 outline-none" 
                                type="text"
                                name="c_password"
                                placeholder="Enter your password again"
                             />
                        </div>
                        <div class="group_input flex flex-col gap-y-2">
                            <span>Gender</span>
                            <select 
                                class="bg-gray-300 py-2 rounded-lg px-4 outline-none"
                                value="male" 
                                name="gender"
                                placeholder="Select your gender"
                                >
                                <option value="m">male</option>
                                <option value="f">female</option>
                                <option value="o">others</option>
                                <option value="n">Nonbinary</option>
                                <option value="i">I don’t know</option>
                            </select>
                        </div>
                        <div class="group_input flex flex-row justify-center">
                            <div class="py-2 px-10 rounded-2xl text-white hover:bg-[#ff0000] bg-[#FF7272]">Register</div>
                        </div>
                </div>
            </div>
            <div class="relative h-[15vh]">
                <div class="w-full h-auto flex flex-row gap-x-2 justify-center">
                    <p>you already account try </p>
                    <a href="login">
                        <span class="text-[#FF0000]">login</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
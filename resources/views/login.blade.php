<!DOCTYPE html>
<html lang="ar" dir="rtl" class=" font-primary">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تسجيل الامتحان</title>
    @vite('resources/css/app.css')
</head>

<body class="flex flex-col justify-between items-stretch min-h-screen">
    @include('includes.header')
    {{-- <h1 class="text-5xl font-semibold px-5 lg:px-10 py-8 border-b-4 p-3 bg-sky-400 border-sky-400 text-white pt-12">
        التسجيل الدخول</h1> --}}
    <section class="px-5 lg:px-10 my-8 flex justify-center items-center">
        <form action="{{route('login.ckeck')}}" method="post">
            @csrf
            <x-form.title class="text-3xl ">تسجيل الدخول</x-form.title>
            <div class=" grid grid-cols-1 gap-y-4">
                <label for="username" class="text-2xl w-auto">اسم المستخدم :</label>
            <input type="text" name="username" id="username" required
                class="text-2xl  indent-3 mr-3 border-dashed outline-none border-b-2 after:bg-sky-500 checked:after:bg-sky-400 border-slate-500 accent-sky-400">
            <label for="password" class="text-2xl w-auto ">كلمة المرور :</label>
            <input type="password" name="password" id="password" required
                class="text-2xl  indent-3 mr-3 border-dashed outline-none border-b-2 after:bg-sky-500 checked:after:bg-sky-400 border-slate-500 accent-sky-400">
            </div>
            <x-input type="button" class="my-8">تسجيل</x-input>
        </form>
    </section>
    @include('includes.footer')
</body>

</html>

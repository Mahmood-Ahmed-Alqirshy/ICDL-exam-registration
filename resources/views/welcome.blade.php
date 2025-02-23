<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    @vite('resources/css/app.css')
    <title>الصفحة الرئيسية</title>
</head>

<body>
    <header class="bg-sky-400 flex">
        <img src="{{ asset('images/logo.svg') }}" alt="not found" class="w-24 h-24 lg:mx-5" />
        <h2
            class="text-white font-primary font-medium flex items-center justify-center mx-5 lg:mx-8 text-3xl lg:text-4xl">
            مركز الاستشارات
        </h2>
    </header>
    <section class="px-5 pt-12 bg-sky-400 lg:px-10 flex flex-col lg:flex-row">
        <img class="lg:w-3/5" src="{{ asset('images/landing.png') }}" alt="" />
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-white text-3xl font-medium text-center">
                مرحباً في الموقع الرسمي لمركز الاستشارات لجامعة العلوم
                والتكنلوجيا
            </h1>
            <a href="#footer"
                class="m-8 text-white font-bold shadow-lg hover:shadow-md bg-green-400 hover:bg-green-600 transition text-2xl p-3 rounded-md block mx-auto">للتواصل</a>
        </div>
    </section>
    {{--
        <hr class="bg-slate-200 h-px my-12 mx-3" />
        --}}
    <section class="px-5 lg:px-10 flex flex-col pt-12 lg:flex-row-reverse">
        <img class="lg:w-3/5" src="{{ asset('images/course.jpg') }}" alt="" />
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-3xl font-medium text-center">
                يمكنك التسجيل في دورة رخصة قيادة الحاسوب الدولية
            </h1>
            <a href="{{ route('course') }}"
                class="text-white shadow-lg hover:shadow-md bg-sky-400 hover:bg-sky-600 transition text-2xl p-3 rounded-md block mx-auto my-5">تسجيل</a>
        </div>
    </section>
    <hr class="bg-slate-200 h-px my-12 mx-3" />
    <section class="px-5 lg:px-10 flex flex-col lg:flex-row">
        <img class="lg:w-3/5" src="{{ asset('images/exam.jpg') }}" alt="" />
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-3xl font-medium text-center">
                يمكنك التسجيل في جلسات الإمتحان الدولية
            </h1>
            <a href="{{ route('exams') }}"
                class="text-white shadow-lg hover:shadow-md bg-sky-400 hover:bg-sky-600 transition text-2xl p-3 rounded-md block mx-auto my-5">تسجيل</a>
        </div>
    </section>
    <footer id="footer" class="text-center p-5 bg-gray-900 mt-8 items-center justify-center">
        <ul class="list-none lg:flex lg:items-center lg:justify-center">
            <li class="text-white text-lg p-5">
                <a href="" class=" flex flex-row-reverse items-center justify-center"><img class="h-8 w-8 mx-4"
                        src="{{ asset('images/facebook.png') }}" alt="" /><span>Facebook</span></a>
            </li>
            <li class="text-white text-lg p-5">
                <a href="" class=" flex flex-row-reverse items-center justify-center"><img class="h-8 w-8 mx-4"
                        src="{{ asset('images/whatsapp.png') }}" alt="" /><span>Whatsapp</span></a>
            </li>
        </ul>
        <p class="p-5 text-gray-500">
            الحقوق محفوظة &copy; جامعة العلوم والتكنلوجيا
        </p>
    </footer>
</body>

</html>

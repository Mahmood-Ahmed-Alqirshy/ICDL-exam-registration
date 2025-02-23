<!DOCTYPE html>
<html lang="ar" dir="rtl" class=" font-primary">

@php
    $day = ['Monday' => 'الاثنين', 'Tuesday' => 'الثلاثاء', 'Wednesday' => 'الأربعاء', 'Thursday' => 'الخميس', 'Friday' => 'الجمعة', 'Saturday' => 'السبت', 'Sunday' => 'الأحد'];
    $status = [
        1 => ['لقد إمتلئت الجلسة', 'red'],
        ['لقد قمت بالتسجيل من قبل', 'red'],
        ['لقد تم تسجيلك بنجاح', 'green'],
        ['تتم مراجعة طلبك سيتم الرجاء مراجعة كشف الاسماء قبل يوم الامتحان', 'yellow']
    ];
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>قائمة الامتحانات</title>
    <style>
        select {
            background: url("{{ asset('images/arrow.png') }}") no-repeat right #ddd;
            background-size: 16px;
            background-position: left 10px center;
        }
    </style>
</head>

<body>
    <header class="bg-sky-400 flex">
        <img src="{{ asset('images/logo.svg') }}" alt="not found" class="w-24 h-24 lg:mx-5" />
        <h2
            class="text-white font-primary font-medium flex items-center justify-center mx-5 lg:mx-8 text-3xl lg:text-4xl">
            مركز الاستشارات
        </h2>
    </header>
    <section class="px-5 bg-sky-400 lg:px-10 flex flex-col lg:flex-row py-12">
        <img class="lg:w-3/5" src="{{ asset('images/exam.png') }}" alt="" />
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-white text-3xl font-medium text-center">
                قائمة الامتحانات المتاحة حالياً
            </h1>
        </div>
    </section>
    <section class="px-5 lg:px-32 my-8">
        @if (request()->get('status'))
        <div class="mb-8 h-24 rounded-md bg-{{$status[request()->get('status')][1]}}-500 text-white text-center flex justify-center items-center">{{$status[request()->get('status')][0]}}</div>
        @endif
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

            @forelse ($exams as $exam)
                <div class=" bg-slate-200 rounded-md w-full">
                    <h2 class="flex justify-center items-center h-48 text-7xl font-semibold">ICDL</h2>
                    <hr class="bg-slate-600 h-0.5 mx-3 my-3" />
                    <p class=" text-xl p-3">
                        اليوم :
                        {{ $day[date('l', strtotime($exam->date))] }}
                    </p>
                    <p class=" text-xl p-3">
                        التاريخ :
                        {{ $exam->date }}
                    </p>
                    <p class=" text-xl p-3">
                        الساعة :
                        {{ date('g:i A', strtotime($exam->time)) }}
                    </p>
                    <a href="{{ route('exams') . '/' . $exam->id }}"
                        class="text-white shadow-lg hover:shadow-md bg-sky-400 hover:bg-sky-600 transition text-xl px-5 py-3 rounded-md m-5 block w-fit">تسجيل</a>
                </div>
                @empty
                    <p class="md:col-span-2 lg:col-span-3 text-3xl text-center h-32 text-slate-600 flex justify-center items-center">لا توجد إمتحانات</p>
                @endforelse
            {{-- @for ($i = 0; $i < 5; $i++)
            <div class=" bg-slate-200 rounded-md w-full">
                <h2 class="flex justify-center items-center h-48 text-7xl font-semibold">ICDL</h2>
                <hr class="bg-slate-800 h-px mx-3 my-3" />
                <p class=" text-xl p-3"> اليوم : الاربعاء</p>
                <p class=" text-xl p-3">التاريخ : 12/12/2012</p>
                <p class=" text-xl p-3">الساعة : 10:00 PM</p>
                <a href="{{route("exams") . '/' . $i}}"
                    class="text-white shadow-lg hover:shadow-md bg-sky-400 hover:bg-sky-600 transition text-xl px-5 py-3 rounded-md m-5 block w-fit">تسجيل</a>
            </div>
                
            @endfor --}}


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

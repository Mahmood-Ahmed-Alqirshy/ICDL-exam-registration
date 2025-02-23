@php
    $levels = ['الاول', 'الثاني', 'الثالث', 'الرابع'];
    $tries = ['الاولة', 'الثانية', 'الثالثة', 'الرابعة'];
    $books = ['كتاب','كتاب','كتاب','كتاب','كتاب','كتاب','كتاب'];
    $majors = ['تخصص','تخصص','تخصص','تخصص','تخصص','تخصص','تخصص','تخصص','تخصص','تخصص','تخصص','تخصص','تخصص','تخصص','تخصص','تخصص','تخصص'];
@endphp

<!DOCTYPE html>
<html lang="ar" dir="rtl" class=" font-primary">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>إنشاء الامتحان</title>
    @vite('resources/css/app.css')
</head>

<body>
    @include('includes.header')
    <h1 class="text-5xl font-semibold px-5 lg:px-10 py-8 border-b-4 p-3 bg-sky-400 border-sky-400 text-white pt-12">
        إنشاء جلسة امتحان دولية</h1>
    <section class="px-5 lg:px-10 my-8">
        <form action="{{route('store')}}" method="post">
            @csrf
            <x-input required type="date" name="date"  id="date">تاريخ الامتحان</x-input>
            <x-form.title>اليوم</x-form.title>
            <p id="day" class="text-xl border-b-2 border-slate-500 border-dashed w-fit p-3 mb-12 mt-8 px-12">اليوم</p>
            <x-form.separator/>
            <x-input required type="time" name="time"  id="time">وقت الامتحان</x-input>
            <x-input name="students" required id="students">عدد الطلاب</x-input>
            <x-form.checkbox name="secondYearPriority" id="P1">الأولوية لطلاب السنة الثانية</x-form.checkbox>
            <br>
            <x-form.checkbox name="technicalMajorsPriority" id="P2">الأولوية لطلاب التخصصات التقنية</x-form.checkbox>
            <br>
            <x-form.checkbox name="internationalNumberPriority" id="P3">الأولوية للطلاب الذين يمتلكون رقم دولي</x-form.checkbox>
            <br>
            {{-- <x-form.checkbox name="uniquePriority" id="P2">الأولوية لطلاب التخصصات التقنية</x-form.checkbox> --}}
            <x-input required type="radio" required name="uniquePriority" id="P4" :choices="[1=>'مسموح','ممنوع في هذه الجلسة','ممنوع في هذا اليوم']">التكرار</x-input>
            <x-input type="button" class="m-8">إنشاء</x-input>  

        </form>
    </section>
    @include('includes.footer')
    <script>
        const weekday = ["الأحد","الإثنين","الثلاثاء","الإربعاء","الخميس","الجمعة","السبت"];
        const dateInput = document.getElementById('date');
        const dayInput = document.getElementById('day');
        dateInput.addEventListener('change', () => {
                const d = new Date(dateInput.value);
                dayInput.innerText = weekday[d.getDay()];
        })
    </script>
</body>

</html>
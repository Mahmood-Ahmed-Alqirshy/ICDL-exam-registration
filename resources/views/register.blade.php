@php
    $levels = [ 1 => 'الاول', 'الثاني', 'الثالث', 'الرابع'];
    $tries = [ 1 => 'الاولة', 'الثانية', 'الثالثة', 'الرابعة'];
    $majorsArray = [];
    foreach ($majors as $major) {
        $majorsArray[$major->id] = $major->name;
    }
    $booksArray = [];
    foreach ($books as $book) {
        $booksArray[$book->id] = $book->name;
    }
@endphp

<!DOCTYPE html>
<html lang="ar" dir="rtl" class=" font-primary">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تسجيل الامتحان</title>
    @vite('resources/css/app.css')
</head>

<body>
    @include('includes.header')
    <h1 class="text-5xl font-semibold px-5 lg:px-10 py-8 border-b-4 p-3 bg-sky-400 border-sky-400 text-white pt-12">
        التسجيل للامتحان الدولي</h1>
    <section class="px-5 lg:px-10 my-8">
        <form action="{{route('try.store',['examSession' => $ExamSessionId])}}" method="post">
            @csrf
            <x-input required name="name"  id="name">الاسم الرباعي</x-input>
            <x-input required type="radio" required name="major" id="major" :choices="$majorsArray">التخصص</x-input>
            <x-input required type="radio" required name="level" id="level" :choices="$levels">المستوى الجامعي</x-input>
            <x-input required type="radio" required name="book" id="book" :choices="$booksArray">الكتاب</x-input>
            <x-input required type="radio" required name="try" id="try" :choices="$tries">رقم المحاولة</x-input>
            <x-input name="number" id="number" note="ان لم يكن لديك اتركه فارغاً">الرقم الدولي</x-input>
            <p class=" my-4 text-lg text-slate-700">هل توافق على كافة <a href="" class="text-sky-400 underline underline-offset-2">الشروط والقوانين</a></p>
            <x-form.checkbox required name="agree" required id="A">اوافق</x-form.checkbox>
            <x-input type="button" class="m-8">تسجيل</x-input>  
        </form>
    </section>
    @include('includes.footer')
</body>

</html>


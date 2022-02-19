@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-14">
    <div class="flex" style="height: 600px;">
        <div class="flex-1">
            <p class="py-4 text-right text-base font-semibold text-dark">ﻒﻴﺸﻟا ﻢﻌﻄﻣ</p>
            <p class="py-4 text-right text-base font-semibold text-dark"> ﻒﻴﺸﻟا ﻢﻋﺎﻄﻣ ﺔﻠﺴﻠﺳ ﻲﻓ ﻚﻴﺑ ﺎﻠﻬﺳو ﺎﻠﻫا</p>

            <p class="py-4 text-right text-base font-semibold text-dark"> ﻢﻟﺎﻌﻟا لﻮﺣ صﺎﺨﺷﺄﻟا ﻦﻴﻳﺎﻠﻣ لﺄﺴﻳ</p>

            <p class="py-4 text-right text-base font-semibold text-dark"> ﻊﻗﻮﻣ ءﺎﻨﺑ ﺔﻠﺣر أﺪﺑ يﺬﻟا لاﺆﺴﻟا ﻮﻫ اﺬﻫ "؟مﻮﻴﻟا
                ﻞﻛأﺄﺳ اذﺎﻣ" مﻮﻳ
                ﻞﻛ
                لاﺆﺴﻟا ﺲﻔﻧ</p>


            <p class="py-4 text-right text-base font-semibold text-dark"> ، ﻪﻤﻌﻃﺄﻟا ﻲﻠﺣاو تﺎﻠﻛﺎﻟا ﺬﻟا مﺪﻘﺗ ﻒﻴﺸﻟا ﻢﻌﻄﻣ
                ﻞﺳﺎﻠﺳ ﺔﻋﻮﻤﺠﻤﻟ</p>
            <p class="py-4 text-right text-base font-semibold text-dark"> يوا ﻚﻴﺗ نﻮﻜﻳ فﻮﺳ ما ﻢﻌﻄﻤﻟا ﻲﻓ ﻢﻜﺗرﺎﻳﺰﺑ ﺎﻨﻓﺮﺸﺘﻫ
                ءاﻮﺳ ﻦﻳﺎﻠﻧوا
                تارادروﺄﻟا ﺐﻠﻃ ﻢﻜﻨﻜﻤﻳ</p>
            <p class="py-4 text-right text-base font-semibold text-dark"> ﻢﻜﺗﺮﻀﺣ ﻲﻠﻋ دﺮﻟﺎﺑ مﻮﻘﻳ فﻮﺳ ءﺎﻠﻤﻌﻟا ﺔﻣﺪﺧ ﻖﻳﺮﻓو
                ﺖﻗو يا ﻲﻓ ﺎﻨﻌﻣ
                ﻞﺻاﻮﺘﻟا ﻦﻜﻤﻳ</p>
        </div>


    </div>

    @include('layouts.partials.cart-row')
</div>

@endsection

@section('javascript')


@endsection

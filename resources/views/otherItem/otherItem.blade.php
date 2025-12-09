@include('layouts.header')
<div class="h-5/6 max-lg:h-[83vh] flex flex-col items-center">
    <!--breadcrumbs-->
    <div class="w-full px-12 py-5 max-sm:px-6">
      <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
          <li class="inline-flex items-center">
            <p class="inline-flex items-center text-sm font-medium text-gray-700">
              <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                  d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
              </svg>
              Main Panel
            </p>
          </li>
          <li aria-current="page">
            <div class="flex items-center">
              <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 9 4-4-4-4" />
              </svg>
              <p class="text-sm font-medium text-gray-700 ms-1 md:ms-2">
                Other Items
              </p>
            </div>
          </li>
        </ol>
      </nav>
    </div>
    <!--Button container-->
    <div class="h-full w-fit">
      <!--buttons-->
      <div
        class="grid grid-cols-2 max-[375px]:grid-cols-1 place-content-center [375px]:justify-items-center h-full gap-6 text-white 2xl:scale-[110%]">
        
        <a href="{{ asset('otherItem/addotherItem')}}">
        <div 
          class="w-[200px] max-xl:w-[150px] h-[200px] max-xl:h-[150px] bg-[{{ $settings[7]->value}}] rounded-lg flex flex-col gap-3 justify-center items-center hover:scale-90 transition-all cursor-pointer uppercase lg:text-xl">
          <img src="../../images/main-panel/btn-icons/add-item.svg"
            class="w-[105px] h-[105px] max-xl:w-[70px] max-xl:h-[70px]" alt="">
          <p>Add Items</p>
        </div>
        </a>

        <a href="{{ asset('otherItem/viewotherItem')}}">
        <div 
          class="w-[200px] max-xl:w-[150px] h-[200px] max-xl:h-[150px] bg-[{{ $settings[7]->value}}] rounded-lg flex flex-col gap-3 justify-center items-center hover:scale-90 transition-all cursor-pointer uppercase lg:text-xl">
          <img src="../../images/main-panel/btn-icons/view-item.svg"
            class="w-[105px] h-[105px] max-xl:w-[70px] max-xl:h-[70px]" alt="">
          <p>View Items</p>
        </div>
        </a>
        
        <a href="{{ asset('otherItem/otherItemBilling')}}">
        <div 
          class="w-[200px] max-xl:w-[150px] h-[200px] max-xl:h-[150px] bg-[{{ $settings[7]->value}}] rounded-lg flex flex-col gap-3 justify-center items-center hover:scale-90 transition-all cursor-pointer uppercase lg:text-xl">
          <img src="../../images/main-panel/btn-icons/billing.svg"
            class="w-[105px] h-[105px] max-xl:w-[70px] max-xl:h-[70px]" alt="">
          <p>Billing</p>
        </div>
        </a>
        
      </div>
    </div>
  </div>
@include('layouts.footer')


</html>
<footer class="bg-[{{ $settings[8]->value }}] py-4 w-full" style="color: {{ $settings[16]->value }};">
    <div class="container px-4 mx-auto">
        <div class="flex flex-col items-center justify-center gap-2 text-center md:flex-row md:gap-4">
            <!-- Year and Rights -->
            <p class="text-sm sm:text-base">{{ now()->year }} © All Rights Reserved</p>
            
            <!-- Separator (hidden on mobile) -->
            <span class="hidden md:block">|</span>
            
            <!-- Company Name -->
            <p class="text-sm sm:text-base">{{ $settings[6]->value }}</p>

        </div>
        
        <!-- Additional responsive elements can be added here -->
    </div>
</footer>
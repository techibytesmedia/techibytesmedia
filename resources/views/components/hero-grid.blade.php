{{-- Grid-box hero background graphic; parent must be relative + overflow-hidden --}}
@props(['showBoxesOnMobile' => false])

<div aria-hidden="true" class="pointer-events-none absolute inset-0 bg-top-right bg-[size:56px_56px] bg-[image:linear-gradient(to_right,var(--color-line)_1px,transparent_1px),linear-gradient(to_bottom,var(--color-line)_1px,transparent_1px)] [mask-image:linear-gradient(to_bottom,black,black_45%,transparent_85%)]"></div>
<div aria-hidden="true" @class(['pointer-events-none absolute inset-0', 'hidden sm:block' => ! $showBoxesOnMobile])>
    <span class="absolute top-14 right-28 h-14 w-14 bg-accent/10"></span>
    <span class="absolute top-28 right-14 h-14 w-14 bg-primary/5"></span>
    <span class="absolute top-42 right-56 h-14 w-14 border border-accent/20"></span>
    <span class="absolute top-70 left-14 h-14 w-14 bg-primary/5"></span>
</div>

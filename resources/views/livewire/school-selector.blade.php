<div>
    <div class="mb-4">
        <x-label for="schoolSearch" class="block text-sm font-medium text-gray-700">Search Schools:</x-label>
        <x-input 
            type="text" 
            wire:model.defer="search" 
            wire:input="applyFilters" 
            id="schoolSearch" 
            placeholder="Type a school name..." 
            class="w-full p-2 border rounded"
        />
    </div>

    <h2 class="mb-4 text-2xl font-semibold">Search Results</h2>
    @if(count($schools) == 0)
        <p class="text-gray-500">No schools found.</p>
    @else
        <ul>
            @foreach($schools as $school)
                <li class="flex items-start justify-between pb-4 border-b border-gray-200 cursor-pointer" 
                    wire:click="selectSchool({{ $school->id }})">
                    <div class="flex-1">
                        <h3 class="text-xl font-bold">{{ $school->denominazionescuola }}</h3>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-100">{{ $school->indirizzoscuola }}</p>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-100">{{ $school->descrizionecComune }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    <input type="hidden" name="school" id="school" value="{{ $selectedSchoolCode }}">
</div>
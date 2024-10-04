<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\School; 

class SchoolSelector extends Component
{
    public $search = '';
    public $schools = [];
    public $selectedSchool = null;
    public $selectedSchoolCode = null;

    public function updatedSearch()
    {
        $this->applyFilters();
    }

    public function applyFilters()
    {
        // Split the search string into an array of keywords
        $keywords = explode(' ', $this->search);
        
        // Start the query
        $query = School::query();
    
        // Check if there are any keywords to search for
        if (!empty($this->search)) {
            foreach ($keywords as $keyword) {
                $trimmedKeyword = trim($keyword);
    
                // Only apply the filters if the keyword is not empty
                if ($trimmedKeyword) {
                    $query->where(function($q) use ($trimmedKeyword) {
                        $q->where('denominazionescuola', 'like', '%' . $trimmedKeyword . '%')
                          ->orWhere('descrizionecComune', 'like', '%' . $trimmedKeyword . '%');
                    });
                }
            }
        }
    
        // Add custom scoring logic
        $this->schools = $query->select('schools.*')
            ->selectRaw("CASE
                WHEN denominazionescuola LIKE '%{$this->search}%' AND descrizionecComune LIKE '%{$this->search}%' THEN 2
                WHEN denominazionescuola LIKE '%{$this->search}%' THEN 1
                WHEN descrizionecComune LIKE '%{$this->search}%' THEN 1
                ELSE 0
            END AS score")
            ->orderBy('score', 'DESC')
            ->limit(10)
            ->get();
    }

    public function selectSchool($schoolId)
    {
        $this->selectedSchool = School::find($schoolId);
        $this->selectedSchoolCode = $this->selectedSchool->codicescuola;
    }

    public function render()
    {
        return view('livewire.school-selector');
    }
}
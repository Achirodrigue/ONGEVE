@php 
    $ss = $categorie->souscategories->count();
    $total = 0;
    if($ss > 0)
    {
        foreach($categorie->souscategories as $souscategorie)
        {
            if($souscategorie->produits->where('isvalide', 1)->count() > 0)
            {
                $total++;
            }
        }
    }
@endphp
<?php 
Route::domain('{account}.financeiro.test')->group(function () {

    $this->get('company/store', 'Tenant\CompanyController@store')->name('company.store');
    $this->get('tenant', function () {
        return 'tenant';
    });
    
});
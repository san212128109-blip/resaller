use App\Http\Controllers\ProductController;

Route::middleware(['auth'])->group(function () {
    // Reseller Routes
    Route::post('/reseller/add-product', [ProductController::class, 'store'])->name('product.store');

    // Admin Routes
    Route::get('/admin/all-products', [ProductController::class, 'adminIndex'])->name('admin.products');
});

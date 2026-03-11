namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct() {
        $this->middleware('auth'); // Sobar age login lagbe
    }

    // --- Reseller Part ---
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        Auth::user()->products()->create($request->all());
        return back()->with('success', 'Product added and waiting for approval!');
    }

    // --- Admin Part ---
    public function adminIndex() {
        // Shudhu admin dekhte parbe
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $products = Product::with('user')->latest()->get();
        return view('admin.dashboard', compact('products'));
    }
}

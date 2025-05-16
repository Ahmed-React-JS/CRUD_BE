<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up(): void
{
Schema::table('tasks', function (Blueprint $table) {
$table->string('title')->nullable();
$table->text('description')->nullable();
$table->softDeletes(); // Adds deleted_at column
});
}

public function down(): void
{
Schema::table('tasks', function (Blueprint $table) {
$table->dropColumn('title');
$table->dropColumn('description');
$table->dropSoftDeletes();
});
}
};

?>
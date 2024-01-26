<?php

namespace App\Console\Commands;

use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use SebastianBergmann\Diff\Exception;

class MoveDataMovieCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:move-data-movie-command {--year=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'move data movies';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        DB::beginTransaction();
        try {
            $year = $this->option('year');
            if (!$year) {
                $year = Carbon::now()->lastOfYear()->format('Y');
            }

            if (!Schema::hasTable('movies_'.$year)) {
                Schema::create('movies_'.$year, function (Blueprint $table) {
                    $table->id();
                    $table->string('name', length: 100);
                    $table->longText('description')->nullable();
                    $table->string('age_limit', length: 2);
                    $table->string('banner', length: 255);
                    $table->longText('trailer')->nullable();
                    $table->boolean('add_to_slide')->nullable()->default(0);
                    $table->unsignedBigInteger('director_id')->nullable()->comment('giám đốc SX');
                    $table->timestamp('start_date')->nullable();
                    $table->timestamp('end_date')->nullable();
                    $table->timestamps();
                });
            }
            $movies = Movie::all()->toArray();
            foreach ($movies as &$movie) {
                $movie['created_at'] = Carbon::create($movie['created_at'])->format('Y-m-d H:i:s');
                $movie['updated_at'] = Carbon::create($movie['updated_at'])->format('Y-m-d H:i:s');
            }
            DB::table('movies_'.$year)->insert($movies);
            Movie::all()->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
}

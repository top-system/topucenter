<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUserFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing users
        Schema::table('users', function ($table) {
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->unique()->nullable();
            }
            if (!Schema::hasColumn('users', 'email')) {
                $table->string('email')->unique()->nullable();
            }
            if (!Schema::hasColumn('users', 'email_verified_at')) {
                $table->string('email_verified_at')->nullable()->default(null);
            }
            if (!Schema::hasColumn('users', 'amount')) {
                $table->decimal('amount')->nullable()->default(0.0);
            }
            if (!Schema::hasColumn('users', 'birthdate')) {
                $table->date('birthdate')->nullable();
            }
            if (!Schema::hasColumn('users', 'sex')) {
                $table->tinyInteger('sex')->nullable()->default(0);
            }
            if (!Schema::hasColumn('users', 'status')) {
                $table->tinyInteger('status')->default(0);
            }
            if (!Schema::hasColumn('users', 'last_login_ip')) {
                $table->tinyInteger('last_login_ip')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'email')) {
            Schema::table('users', function ($table) {
                $table->dropColumn('email');
            });
        }
        if (Schema::hasColumn('users', 'email_verified_at')) {
            Schema::table('users', function ($table) {
                $table->dropColumn('email_verified_at');
            });
        }
        if (Schema::hasColumn('users', 'amount')) {
            Schema::table('users', function ($table) {
                $table->dropColumn('amount');
            });
        }
        if (Schema::hasColumn('users', 'birthdate')) {
            Schema::table('users', function ($table) {
                $table->dropColumn('birthdate');
            });
        }
        if (Schema::hasColumn('users', 'sex')) {
            Schema::table('users', function ($table) {
                $table->dropColumn('sex');
            });
        }
        if (Schema::hasColumn('users', 'status')) {
            Schema::table('users', function ($table) {
                $table->dropColumn('status');
            });
        }
        if (Schema::hasColumn('users', 'last_login_ip')) {
            Schema::table('users', function ($table) {
                $table->dropColumn('last_login_ip');
            });
        }
    }
}

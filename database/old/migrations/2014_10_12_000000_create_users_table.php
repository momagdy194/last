    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateUsersTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('users', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('first_name');
                $table->string('last_name');
                $table->string('email')->unique();
                $table->boolean('email_verified')->default(false);
                $table->string('phone')->nullable();
                $table->boolean('phone_verified')->default(false);
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
                $table->string('shipping_address')->nullable();
                $table->string('billing_address')->nullable();
                $table->string('api_token','60')->unique();

            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('users');
        }
    }

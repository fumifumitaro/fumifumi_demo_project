<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class SampleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFailedLoginWithoutParameter()
    {
        // テスト用の環境に変更
        Config::set('app.env', 'testing');

        // パラメータなしでログインを叩く
        $response = $this->post('/login');

        $errors = $response->exception->validator->getMessageBag();

        $assert = false;

        // バリデーションエラーが予期した通りならテストオッケーの報せとしてtrue
        if ($errors->get('email')[0] === 'メールアドレスは必ず指定してください。'
            && $errors->get('password')[0] === 'パスワードは必ず指定してください。'
        ) {
            $assert = true;
        }

        $this->assertTrue($assert);
    }

    public function testLoginFailedMissMatchPassword()
    {
        Config::set('app.env', 'testing');

        // test用のユーザーデータの用意、traitにTransactionを入れているのでテスト内のデータはテスト終了時に削除されます。
        $user = factory(User::class)->create();

        // パスワードをわざと間違えてログインを叩く
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'aaaaa'
        ]);

        $response->assertStatus(302);

        $errors = $response->exception->validator->getMessageBag();

        $assert = false;

        // ログインミスの時のメッセージが取れるはず
        if ($errors->get('email')[0] === 'ログイン情報が登録されていません。') {
            $assert = true;
        }

        $this->assertTrue($assert);
    }

    public function testLoginSuccess()
    {
        Config::set('app.env', 'testing');

        $user = factory(User::class)->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        // 正常にログインできた場合は例外を吐かない
        $errors = $response->exception;
        $assert = false;
        if($errors === null){
            $assert = true;
        }

        $this->assertTrue($assert);

        $response->assertRedirect('/');
    }
}

<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Candidato;
use App\Empresa;
use App\Escolaridade;
use App\Experiencia;
use App\Endereco;
use App\Vaga;
use App\Cargo;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\User');

        //usuário
        for($i=1;$i<=50;$i++){
            User::create([
                'name'              =>  $faker->name,
                'email'             =>  $faker->email,
                'password'          =>  bcrypt('candidato123'),
                'email_verified_at' =>  now(),
            ]);
        }
        //usuário - candidato
        for($i=1;$i<=25;$i++){
            Candidato::create([
                'user_id'               =>  $i,
                'nome_completo'         =>  $faker->name,
                'cpf'                   =>  "00000000001",
                'email'                 =>  $faker->email,
                'telefone'              =>  $faker->tollFreePhoneNumber,
                'celular'               =>  $faker->tollFreePhoneNumber,
                'tipo_de_deficiencia'   =>  " ",
                'data_de_nascimento'    =>  $faker->dateTime,
            ]);
        }
        //usuário - empresa
        for($i=26;$i<=50;$i++){
            Empresa::create([
                'user_id'               =>  $i,
                'nome_empresa'          =>  strtolower($faker->company),
                'cnpj'                  =>  "00000000001",
                'email'                 =>  $faker->email,
                'telefone'              =>  $faker->tollFreePhoneNumber,
            ]);
        }

        //############################ candidato ##############################
        //endereco
        for($i=1;$i<=25;$i++){
            Endereco::create([
                'empresa_id'            =>  $i,
                // 'vaga_id'               =>  ,
                'uf'                    =>  "PE",
                'cidade'                =>  "Recife",
                'bairro'                =>  "Boa Viagem",
                'rua'                   =>  "Rua da Prosperidade",
                'numero'                =>  "42a",
            ]);
        }
        //escolaridade
        for($i=1;$i<=25;$i++){
            Escolaridade::create([
                'candidato_id'          =>  $i,
                'instituicao'           =>  "UFPE",
                'curso'                 =>  "Artes",
                'data_inicio'           =>  $faker->dateTime,
                'data_conclusao'        =>  $faker->dateTime,

            ]);
        }
        //experiencia
        for($i=1;$i<=25;$i++){
            Experiencia::create([
                'candidato_id'          =>  $i,
                'nome_empresa'          =>  "polishop",
                'atribuicao'            =>  "vendedor",
                'data_inicio'           =>  $faker->dateTime,
                'data_fim'              =>  $faker->dateTime,
            ]);
        }
        //cargo
        for($i=1;$i<=25;$i++){
            Cargo::create([
                'experiencia_id'         =>  $i,
                'nome_cargo'             =>  "operador de vendas",
            ]);
        }

        //############################ empresa ##############################
        //empresa
        for($i=26;$i<=50;$i++){
            //$jobtitle = $faker->jobTitle;
             Empresa::create([
                'user_id'               => $i,
                'nome_empresa'          => $faker->company,
                'cnpj'                  => "00000000000001",
                'telefone'              => $faker->phoneNumber,
                'email'                 => $faker->email,
             ]);
         }
        //endereco
        for($i=26;$i<=50;$i++){
            //$jobtitle = $faker->jobTitle;
             Endereco::create([
                'empresa_id'            => $i,
                'uf'                    => "PE",
                'cidade'                => "Garanhuns",
                'bairro'                => "São José",
                'rua'                   => "Prosperidade",
                'numero'                => "1234",
             ]);
         }
        //vaga
        for($i=1;$i<=25;$i++){
           $jobtitle = $faker->jobTitle;
            Vaga::create([
               'empresa_id'             => $i,
               'data_publicacao'        => $faker->dateTime,
               'nome_vaga'              => $jobtitle,
               'atribuicoes'            => $jobtitle,
               'experiencia'            => $jobtitle,
               'descricao'              => $jobtitle,
               'quantidade'             => 1,
               'salario'                => 1000,
               'vaga_para_pcd'          => 1,
               'tipo_de_vaga'           => 1,
               'tipo_de_remuneracao'    => 1,
               //'funcao' => $jobtitle,
            ]);
        }
        for($i=1;$i<=25;$i++){
            $jobtitle = $faker->jobTitle;
             Vaga::create([
                'empresa_id'             => $i,
                'data_publicacao'        => $faker->dateTime,
                'nome_vaga'              => $jobtitle,
                'atribuicoes'            => $jobtitle,
                'experiencia'            => $jobtitle,
                'descricao'              => $jobtitle,
                'quantidade'             => 1,
                'salario'                => 1000,
                'vaga_para_pcd'          => 1,
                'tipo_de_vaga'           => 1,
                'tipo_de_remuneracao'    => 1,
                //'funcao' => $jobtitle,
             ]);
         }for($i=1;$i<=25;$i++){
            //$jobtitle = $faker->jobTitle;
             Vaga::create([
                'empresa_id'             => $i,
                'data_publicacao'        => $faker->dateTime,
                'nome_vaga'              => $jobtitle,
                'atribuicoes'            => $jobtitle,
                'experiencia'            => $jobtitle,
                'descricao'              => $jobtitle,
                'quantidade'             => 1,
                'salario'                => 1000,
                'vaga_para_pcd'          => 1,
                'tipo_de_vaga'           => 1,
                'tipo_de_remuneracao'    => 1,
                //'funcao' => $jobtitle,
             ]);
         }

        User::create([
            'name'                      =>  "Danillo",
            'email'                     =>  "danillo@gmail.com",
            'password'                  =>  bcrypt('12345678'),
            'email_verified_at'         =>  now(),
        ]);
        User::create([
            'name'                      =>  "Alixandre",
            'email'                     =>  "alixandre@gmail.com",
            'password'                  =>  bcrypt('12345678'),
            'email_verified_at'         =>  now(),
        ]);
        User::create([
            'name'                      =>  "Jose",
            'email'                     =>  "jose@gmail.com",
            'password'                  =>  bcrypt('12345678'),
            'email_verified_at'         =>  now(),
        ]);
    }
}

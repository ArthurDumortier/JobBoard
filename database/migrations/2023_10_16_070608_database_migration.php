<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        // Table: status
        Schema::create('status', function (Blueprint $table) {
            $table->id();
            $table->string('libelleStatus', 50);
            $table->string('couleur', 50);
        });

        // Table: role
        Schema::create('role', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 50);
        });

        // Table: reseaux
        Schema::create('reseaux', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 256);
        });

        // Table: domaine
        Schema::create('domaine', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 256);
        });

        // Table: typecontrat
        Schema::create('typecontrat', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 256);
        });

        // Table: entreprise
        Schema::create('entreprise', function (Blueprint $table) {
            $table->id();
            $table->string('nomEntreprise', 256);
            $table->string('descriptionEntreprise', 256);
            $table->string('siegeSocial', 50);
            $table->integer('nbSalarie');
            $table->date('date_creation');
        });

        // Table: domaineentreprise
        Schema::create('domaineentreprise', function (Blueprint $table) {
            $table->unsignedBigInteger('idEntreprise');
            $table->unsignedBigInteger('idDomaine');
            $table->primary(['idEntreprise', 'idDomaine']);
            $table->foreign('idEntreprise')->references('id')->on('entreprise');
            $table->foreign('idDomaine')->references('id')->on('domaine');
        });

        // Table: reseauxsociaux
        Schema::create('reseauxsociaux', function (Blueprint $table) {
            $table->unsignedBigInteger('idEntreprise');
            $table->unsignedBigInteger('idReseaux');
            $table->string('libelle', 256);
            $table->primary(['idEntreprise', 'idReseaux']);
            $table->foreign('idEntreprise')->references('id')->on('entreprise');
            $table->foreign('idReseaux')->references('id')->on('reseaux');
        });

        // Table: user
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('identifiant', 256);
            $table->string('password', 256);
            $table->date('date_creation');
            $table->string('remember_token', 255)->nullable();
            $table->unsignedBigInteger('roleId');
            $table->string('email', 256);
            $table->string('firstName', 50);
            $table->string('lastName', 50);
            $table->string('adresse', 256);
            $table->string('codePostal', 5);
            $table->string('ville', 50);
            $table->string('telephone', 20);
            $table->tinyInteger('isActive');
            $table->string('pays', 50);
            $table->unsignedBigInteger('idEntreprise')->nullable();
            $table->foreign('roleId')->references('id')->on('role');
            $table->foreign('idEntreprise')->references('id')->on('entreprise');
        });


        // Table: annonce
        Schema::create('annonce', function (Blueprint $table) {
            $table->id();
            $table->string('titre', 50);
            $table->text('description');
            $table->unsignedBigInteger('entrepriseId');
            $table->unsignedBigInteger('typeContratId');
            $table->float('salaireMinAn');
            $table->float('salaireMaxAn');
            $table->date('creationDate');
            $table->float('duree');
            $table->string('adresse', 256);
            $table->string('ville', 50);
            $table->string('codePostal', 5);
            $table->unsignedBigInteger('idUser');
            $table->date('dateDebut');
            $table->date('dateFin');
            $table->foreign('entrepriseId')->references('id')->on('entreprise');
            $table->foreign('typeContratId')->references('id')->on('typecontrat');
            $table->foreign('idUser')->references('id')->on('user');
        });

        // Table: postuleur
        Schema::create('postuleur', function (Blueprint $table) {
            $table->id('postuleurId');
            $table->unsignedBigInteger('idUser')->nullable();
            $table->unsignedBigInteger('idAnnonce');
            $table->string('cv', 256)->nullable();
            $table->string('lettreMotivation', 256)->nullable();
            $table->unsignedBigInteger('idStatus');
            $table->date('datePostulage')->nullable();
            $table->string('firstName', 50)->nullable();
            $table->string('lastName', 50)->nullable();
            $table->string('email', 256)->nullable();
            $table->foreign('idUser')->references('id')->on('user');
            $table->foreign('idAnnonce')->references('id')->on('annonce');
            $table->foreign('idStatus')->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('typecontrat');
        Schema::dropIfExists('status');
        Schema::dropIfExists('role');
        Schema::dropIfExists('reseaux');
        Schema::dropIfExists('reseauxsociaux');
        Schema::dropIfExists('domaine');
        Schema::dropIfExists('entreprise');
        Schema::dropIfExists('domaineentreprise');
        Schema::dropIfExists('annonce');
        Schema::dropIfExists('postuleur');
        Schema::dropIfExists('user');
    }
};

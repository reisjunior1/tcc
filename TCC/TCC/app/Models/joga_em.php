<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class joga_em extends Model
{
    use HasFactory;

    protected $fillable = [
    'id_jogador',
    'id_time',
    'Eexcluido'];

    protected $table = 'joga_em';

    public function joga_em()
    {
        return $this->belongsTo(joga_em::class);
    }

    public function lstJogadoresPorTime($idTime, $jogadoresAtivos = null, $jogaEm = null)
    {
        $query = time::select('jogadores.id', 'jogadores.nome', 'jogadores.apelido', 'joga_em.Eexcluido',
            'joga_em.id as idJogaEm')
            ->from('joga_em')
            ->join('jogadores', 'jogadores.id', '=', 'joga_em.id_jogador')
            ->where('joga_em.id_time', '=', $idTime)
            ->orderby('jogadores.nome');

            $query->when(!is_null($jogadoresAtivos), function ($q) use ($jogadoresAtivos) {
                return $q->where('jogadores.Eexcluido', '=', $jogadoresAtivos);
            });

            $query->when(!is_null($jogaEm), function ($q) use ($jogaEm) {
                return $q->where('joga_em.Eexcluido', '=', $jogaEm);
            });
            //->toSql();
            //dd($query);
            return $query->get()->toArray();
    }

    public function insJogador($idTime, $idJogador)
    {
        $objTime = new joga_em();
        
        return $objTime->create([
            'id_jogador'=>$idJogador,
            'id_time' => $idTime,
            'Eexcluido' => 0
        ]);
    }

    public function delJogador($id)
    {
        joga_em::where(['id'=>$id])->update([
            'Eexcluido'=>1
        ]);

        return true;
    }
}

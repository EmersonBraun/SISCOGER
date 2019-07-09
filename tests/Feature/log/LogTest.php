<?php

namespace Tests\Feature\log;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogTest extends TestCase
{
	/**
	 * Acessos
	 *
	 * @return void
	 */
	public function testAcessosWithError()
	{
		$response = $this->json('GET', '/log/acessos', []);

		$response->assertStatus(400);

	}

	/**
	 * Acessos
	 *
	 * @return void
	 */
	public function testAcessos()
	{
		$response = $this->json('GET', '/log/acessos', []);

		$response->assertStatus(200);

	}

	/**
	 * Bloqueios
	 *
	 * @return void
	 */
	public function testBloqueiosWithError()
	{
		$response = $this->json('GET', '/log/bloqueios', []);

		$response->assertStatus(400);

	}

	/**
	 * Bloqueios
	 *
	 * @return void
	 */
	public function testBloqueios()
	{
		$response = $this->json('GET', '/log/bloqueios', []);

		$response->assertStatus(200);

	}

	/**
	 * Adl
	 *
	 * @return void
	 */
	public function testAdlWithError()
	{
		$response = $this->json('GET', '/log/adl', []);

		$response->assertStatus(400);

	}

	/**
	 * Adl
	 *
	 * @return void
	 */
	public function testAdl()
	{
		$response = $this->json('GET', '/log/adl', []);

		$response->assertStatus(200);

	}

	/**
	 * Apfd
	 *
	 * @return void
	 */
	public function testApfdWithError()
	{
		$response = $this->json('GET', '/log/apfd', []);

		$response->assertStatus(400);

	}

	/**
	 * Apfd
	 *
	 * @return void
	 */
	public function testApfd()
	{
		$response = $this->json('GET', '/log/apfd', []);

		$response->assertStatus(200);

	}

	/**
	 * Cj
	 *
	 * @return void
	 */
	public function testCjWithError()
	{
		$response = $this->json('GET', '/log/cj', []);

		$response->assertStatus(400);

	}

	/**
	 * Cj
	 *
	 * @return void
	 */
	public function testCj()
	{
		$response = $this->json('GET', '/log/cj', []);

		$response->assertStatus(200);

	}

	/**
	 * Cd
	 *
	 * @return void
	 */
	public function testCdWithError()
	{
		$response = $this->json('GET', '/log/cd', []);

		$response->assertStatus(400);

	}

	/**
	 * Cd
	 *
	 * @return void
	 */
	public function testCd()
	{
		$response = $this->json('GET', '/log/cd', []);

		$response->assertStatus(200);

	}

	/**
	 * It
	 *
	 * @return void
	 */
	public function testItWithError()
	{
		$response = $this->json('GET', '/log/it', []);

		$response->assertStatus(400);

	}

	/**
	 * It
	 *
	 * @return void
	 */
	public function testIt()
	{
		$response = $this->json('GET', '/log/it', []);

		$response->assertStatus(200);

	}

	/**
	 * Iso
	 *
	 * @return void
	 */
	public function testIsoWithError()
	{
		$response = $this->json('GET', '/log/iso', []);

		$response->assertStatus(400);

	}

	/**
	 * Iso
	 *
	 * @return void
	 */
	public function testIso()
	{
		$response = $this->json('GET', '/log/iso', []);

		$response->assertStatus(200);

	}

	/**
	 * Fatd
	 *
	 * @return void
	 */
	public function testFatdWithError()
	{
		$response = $this->json('GET', '/log/fatd', []);

		$response->assertStatus(400);

	}

	/**
	 * Fatd
	 *
	 * @return void
	 */
	public function testFatd()
	{
		$response = $this->json('GET', '/log/fatd', []);

		$response->assertStatus(200);

	}

	/**
	 * Pad
	 *
	 * @return void
	 */
	public function testPadWithError()
	{
		$response = $this->json('GET', '/log/pad', []);

		$response->assertStatus(400);

	}

	/**
	 * Pad
	 *
	 * @return void
	 */
	public function testPad()
	{
		$response = $this->json('GET', '/log/pad', []);

		$response->assertStatus(200);

	}

	/**
	 * Sindicancia
	 *
	 * @return void
	 */
	public function testSindicanciaWithError()
	{
		$response = $this->json('GET', '/log/sindicancia', []);

		$response->assertStatus(400);

	}

	/**
	 * Sindicancia
	 *
	 * @return void
	 */
	public function testSindicancia()
	{
		$response = $this->json('GET', '/log/sindicancia', []);

		$response->assertStatus(200);

	}

	/**
	 * Sai
	 *
	 * @return void
	 */
	public function testSaiWithError()
	{
		$response = $this->json('GET', '/log/sai', []);

		$response->assertStatus(400);

	}

	/**
	 * Sai
	 *
	 * @return void
	 */
	public function testSai()
	{
		$response = $this->json('GET', '/log/sai', []);

		$response->assertStatus(200);

	}

	/**
	 * Procoutros
	 *
	 * @return void
	 */
	public function testProcoutrosWithError()
	{
		$response = $this->json('GET', '/log/procoutros', []);

		$response->assertStatus(400);

	}

	/**
	 * Procoutros
	 *
	 * @return void
	 */
	public function testProcoutros()
	{
		$response = $this->json('GET', '/log/procoutros', []);

		$response->assertStatus(200);

	}

	/**
	 * Desercao
	 *
	 * @return void
	 */
	public function testDesercaoWithError()
	{
		$response = $this->json('GET', '/log/desercao', []);

		$response->assertStatus(400);

	}

	/**
	 * Desercao
	 *
	 * @return void
	 */
	public function testDesercao()
	{
		$response = $this->json('GET', '/log/desercao', []);

		$response->assertStatus(200);

	}

	/**
	 * Exclusao
	 *
	 * @return void
	 */
	public function testExclusaoWithError()
	{
		$response = $this->json('GET', '/log/exclusao', []);

		$response->assertStatus(400);

	}

	/**
	 * Exclusao
	 *
	 * @return void
	 */
	public function testExclusao()
	{
		$response = $this->json('GET', '/log/exclusao', []);

		$response->assertStatus(200);

	}

	/**
	 * Ipm
	 *
	 * @return void
	 */
	public function testIpmWithError()
	{
		$response = $this->json('GET', '/log/ipm', []);

		$response->assertStatus(400);

	}

	/**
	 * Ipm
	 *
	 * @return void
	 */
	public function testIpm()
	{
		$response = $this->json('GET', '/log/ipm', []);

		$response->assertStatus(200);

	}

	/**
	 * Movimento
	 *
	 * @return void
	 */
	public function testMovimentoWithError()
	{
		$response = $this->json('GET', '/log/movimento', []);

		$response->assertStatus(400);

	}

	/**
	 * Movimento
	 *
	 * @return void
	 */
	public function testMovimento()
	{
		$response = $this->json('GET', '/log/movimento', []);

		$response->assertStatus(200);

	}

	/**
	 * Recurso
	 *
	 * @return void
	 */
	public function testRecursoWithError()
	{
		$response = $this->json('GET', '/log/recurso', []);

		$response->assertStatus(400);

	}

	/**
	 * Recurso
	 *
	 * @return void
	 */
	public function testRecurso()
	{
		$response = $this->json('GET', '/log/recurso', []);

		$response->assertStatus(200);

	}

	/**
	 * Notacoger
	 *
	 * @return void
	 */
	public function testNotacogerWithError()
	{
		$response = $this->json('GET', '/log/notacoger', []);

		$response->assertStatus(400);

	}

	/**
	 * Notacoger
	 *
	 * @return void
	 */
	public function testNotacoger()
	{
		$response = $this->json('GET', '/log/notacoger', []);

		$response->assertStatus(200);

	}

	/**
	 * Apresentacao
	 *
	 * @return void
	 */
	public function testApresentacaoWithError()
	{
		$response = $this->json('GET', '/log/apresentacao', []);

		$response->assertStatus(400);

	}

	/**
	 * Apresentacao
	 *
	 * @return void
	 */
	public function testApresentacao()
	{
		$response = $this->json('GET', '/log/apresentacao', []);

		$response->assertStatus(200);

	}

	/**
	 * Locaisapresentacao
	 *
	 * @return void
	 */
	public function testLocaisapresentacaoWithError()
	{
		$response = $this->json('GET', '/log/locaisapresentacao', []);

		$response->assertStatus(400);

	}

	/**
	 * Locaisapresentacao
	 *
	 * @return void
	 */
	public function testLocaisapresentacao()
	{
		$response = $this->json('GET', '/log/locaisapresentacao', []);

		$response->assertStatus(200);

	}

	/**
	 * Email
	 *
	 * @return void
	 */
	public function testEmailWithError()
	{
		$response = $this->json('GET', '/log/email', []);

		$response->assertStatus(400);

	}

	/**
	 * Email
	 *
	 * @return void
	 */
	public function testEmail()
	{
		$response = $this->json('GET', '/log/email', []);

		$response->assertStatus(200);

	}

	/**
	 * Consulta
	 *
	 * @return void
	 */
	public function testConsultaWithError()
	{
		$response = $this->json('GET', '/log/consulta', []);

		$response->assertStatus(400);

	}

	/**
	 * Consulta
	 *
	 * @return void
	 */
	public function testConsulta()
	{
		$response = $this->json('GET', '/log/consulta', []);

		$response->assertStatus(200);

	}

	/**
	 * Fdi
	 *
	 * @return void
	 */
	public function testFdiWithError()
	{
		$response = $this->json('GET', '/log/fdi', []);

		$response->assertStatus(400);

	}

	/**
	 * Fdi
	 *
	 * @return void
	 */
	public function testFdi()
	{
		$response = $this->json('GET', '/log/fdi', []);

		$response->assertStatus(200);

	}

	/**
	 * Apagados
	 *
	 * @return void
	 */
	public function testApagadosWithError()
	{
		$response = $this->json('GET', '/log/apagados', []);

		$response->assertStatus(400);

	}

	/**
	 * Apagados
	 *
	 * @return void
	 */
	public function testApagados()
	{
		$response = $this->json('GET', '/log/apagados', []);

		$response->assertStatus(200);

	}

	/**
	 * Papeis
	 *
	 * @return void
	 */
	public function testPapeisWithError()
	{
		$response = $this->json('GET', '/log/papeis', []);

		$response->assertStatus(400);

	}

	/**
	 * Papeis
	 *
	 * @return void
	 */
	public function testPapeis()
	{
		$response = $this->json('GET', '/log/papeis', []);

		$response->assertStatus(200);

	}

	/**
	 * Permissoes
	 *
	 * @return void
	 */
	public function testPermissoesWithError()
	{
		$response = $this->json('GET', '/log/permissoes', []);

		$response->assertStatus(400);

	}

	/**
	 * Permissoes
	 *
	 * @return void
	 */
	public function testPermissoes()
	{
		$response = $this->json('GET', '/log/permissoes', []);

		$response->assertStatus(200);

	}

	/**
	 * Feriado
	 *
	 * @return void
	 */
	public function testFeriadoWithError()
	{
		$response = $this->json('GET', '/log/feriado', []);

		$response->assertStatus(400);

	}

	/**
	 * Feriado
	 *
	 * @return void
	 */
	public function testFeriado()
	{
		$response = $this->json('GET', '/log/feriado', []);

		$response->assertStatus(200);

	}

	/**
	 * Cadastroopmcoger
	 *
	 * @return void
	 */
	public function testCadastroopmcogerWithError()
	{
		$response = $this->json('GET', '/log/cadastroopmcoger', []);

		$response->assertStatus(400);

	}

	/**
	 * Cadastroopmcoger
	 *
	 * @return void
	 */
	public function testCadastroopmcoger()
	{
		$response = $this->json('GET', '/log/cadastroopmcoger', []);

		$response->assertStatus(200);

	}

	/**
	 * Comportamentopm
	 *
	 * @return void
	 */
	public function testComportamentopmWithError()
	{
		$response = $this->json('GET', '/log/comportamentopm', []);

		$response->assertStatus(400);

	}

	/**
	 * Comportamentopm
	 *
	 * @return void
	 */
	public function testComportamentopm()
	{
		$response = $this->json('GET', '/log/comportamentopm', []);

		$response->assertStatus(200);

	}

	/**
	 * Denunciacivil
	 *
	 * @return void
	 */
	public function testDenunciacivilWithError()
	{
		$response = $this->json('GET', '/log/denunciacivil', []);

		$response->assertStatus(400);

	}

	/**
	 * Denunciacivil
	 *
	 * @return void
	 */
	public function testDenunciacivil()
	{
		$response = $this->json('GET', '/log/denunciacivil', []);

		$response->assertStatus(200);

	}

	/**
	 * Elogio
	 *
	 * @return void
	 */
	public function testElogioWithError()
	{
		$response = $this->json('GET', '/log/elogio', []);

		$response->assertStatus(400);

	}

	/**
	 * Elogio
	 *
	 * @return void
	 */
	public function testElogio()
	{
		$response = $this->json('GET', '/log/elogio', []);

		$response->assertStatus(200);

	}

	/**
	 * Reintegrado
	 *
	 * @return void
	 */
	public function testReintegradoWithError()
	{
		$response = $this->json('GET', '/log/reintegrado', []);

		$response->assertStatus(400);

	}

	/**
	 * Reintegrado
	 *
	 * @return void
	 */
	public function testReintegrado()
	{
		$response = $this->json('GET', '/log/reintegrado', []);

		$response->assertStatus(200);

	}

	/**
	 * Falecimento
	 *
	 * @return void
	 */
	public function testFalecimentoWithError()
	{
		$response = $this->json('GET', '/log/falecimento', []);

		$response->assertStatus(400);

	}

	/**
	 * Falecimento
	 *
	 * @return void
	 */
	public function testFalecimento()
	{
		$response = $this->json('GET', '/log/falecimento', []);

		$response->assertStatus(200);

	}

	/**
	 * Preso
	 *
	 * @return void
	 */
	public function testPresoWithError()
	{
		$response = $this->json('GET', '/log/preso', []);

		$response->assertStatus(400);

	}

	/**
	 * Preso
	 *
	 * @return void
	 */
	public function testPreso()
	{
		$response = $this->json('GET', '/log/preso', []);

		$response->assertStatus(200);

	}

	/**
	 * Restricao
	 *
	 * @return void
	 */
	public function testRestricaoWithError()
	{
		$response = $this->json('GET', '/log/restricao', []);

		$response->assertStatus(400);

	}

	/**
	 * Restricao
	 *
	 * @return void
	 */
	public function testRestricao()
	{
		$response = $this->json('GET', '/log/restricao', []);

		$response->assertStatus(200);

	}

	/**
	 * Suspenso
	 *
	 * @return void
	 */
	public function testSuspensoWithError()
	{
		$response = $this->json('GET', '/log/suspenso', []);

		$response->assertStatus(400);

	}

	/**
	 * Suspenso
	 *
	 * @return void
	 */
	public function testSuspenso()
	{
		$response = $this->json('GET', '/log/suspenso', []);

		$response->assertStatus(200);

	}

	/**
	 * Tramitacaoopm
	 *
	 * @return void
	 */
	public function testTramitacaoopmWithError()
	{
		$response = $this->json('GET', '/log/tramitacaoopm', []);

		$response->assertStatus(400);

	}

	/**
	 * Tramitacaoopm
	 *
	 * @return void
	 */
	public function testTramitacaoopm()
	{
		$response = $this->json('GET', '/log/tramitacaoopm', []);

		$response->assertStatus(200);

	}

}

<?php  
{{Form::select('procedimento', 
      [
            'ipm' => 'Inquérito Policial Militar',
           'sindicancia' => 'Sindicância',
           'cj' => 'Conselho de Justificação',
           'cd' => 'Conselho de Disciplina',
           'it' => 'Inquérito Técnico',
           'adl' => 'Apuração Disciplinar de Licenciamento',
           'apfd' => 'Auto de Prisão em Flagrante Delito',
           'fatd' => 'Formulário de Apuração de Transgressão Disciplinar',
           'iso' => 'Inquérito Sanitário de Origem',
           'desercao' => 'Deserção',
           'sai' => 'Investigação Policial'
      ]
); }}
?>
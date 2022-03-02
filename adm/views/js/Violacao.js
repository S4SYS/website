class Violacao
{
    init($content)
    {
        $content.html(this.getCard().join(''));    
    }

    getCard()
    {
        return [
            ...this.getCardHeader(),
            ...this.getCardBody(),
        ];
    }

    getCardHeader()
    {
        return [
            '<div class="card-header py-3">',
            '<h6 class="m-0 font-weight-bold text-primary">',
            'Lista de Viola&ccedil;&otilde;es',
            '</h6>',
            '</div>'
        ];
    }

    getCardBody()
    {
        return [
            '<div class="card-body">',
            '<div class="table-responsive">',
            ...this.getTable(),
            '</div>',
            '</div>'
        ];
    }

    getTable()
    {
        return [
            '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">',
            ...this.getTableHead(),
            ...this.getTableBody(),
            '</table>'
        ];
    }

    getTableHead()
    {
        let titles = [
            'C&oacute;digo',
            'CPF',
            'Email',
            'Nome Completo',
            'Telefone',
            'Viola&ccedil;&atilde;o',
            'Data',
            'Arquivo',
            'Status'
        ];

        let columns = titles.map(col => { return `<th>${col}</th>`; });
        
        return ['<thead>', '<tr>', ...columns, '</tr>', '</thead>'];
    }

    getTableBody()
    {
        return [
            '<tbody>',
            '</tbody>'
        ];
    }
}
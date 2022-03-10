class Lista
{
    cardTitle;
    tableHeadTitles;
    tableBodyContent;
    actionName;
    requestBody;


    setContent()
    {
        let self = this;        
        $.get('../api.php', { acao : this.actionName }, response => {          
            self.$content
            .html(self.getCard().join(''))
            .find('table')
            .find('tbody')
            .html(self.getBodyContent(response.data).join(''));

            self.$content.find('table')
            .DataTable(
                {
                    responsive : true,
                    dom: 'Bfrtip',
                    buttons: [
                        'colvis'
                    ],
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
                    }                    
                });
          
        }, 'json');
    }

    getBodyContent(dados)
    {
        return dados.map(this.requestBody);
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
            this.cardTitle,
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
            '<table class="table table-bordered display responsive nowrap" id="dataTable" width="100%">',
            ...this.getTableHead(),
            ...this.getTableBody(),
            '</table>'
        ];
    }

    getTableHead()
    {        
        let columns = this.tableHeadTitles.map(col => { return `<th>${col}</th>`; });
        
        return ['<thead>', '<tr>', ...columns, '</tr>', '</thead>'];
    }

    getTableBody()
    {
        return [
            '<tbody>',
            '</tbody>'
        ];
    }
    
    getActionModal()
    {
        return `
        $('#actionModal').modal('show')
        .find('#btnSalvar')
        .attr('data-hash', this.dataset.hash)
        .attr('data-id', this.dataset.id)
        .attr('data-action', this.dataset.action);
        `;
    }
}
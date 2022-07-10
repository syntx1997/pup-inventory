const requestsTable = $('#requests-table');
const api = '/api/request/';

$(function (){
    const requestsDataTable = requestsTable.DataTable({
        'ajax': api+'all',
        'columns': [
            {
                'className': 'details-control',
                'orderable': false,
                'data': '',
                'defaultContent': ''
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'transaction_id'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'name'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'office'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'actions'
            }
        ]
    });

    $('#requests-table tbody').on('click', 'td.details-control', function() {
        const tr = $(this).closest('tr');
        const row = requestsDataTable.row( tr );

        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            row.child( more_details( row.data() ) ).show();
            tr.addClass('shown');
        }
    });
});

function more_details(data) {
    let items = '';

    data.items.map((item) => {
        items += `
            <tr>
                <td class="text-center">${item.name}</td>
                <td class="text-center">${item.description}</td>
                <td class="text-center">${item.quantity}</td>
            </tr>
        `;
    });

    return `
        <h5 class="text-center"><strong>Items Request/s (${data.items.length})</strong></h5>
        <table class="table border" style="width: 100%">
            <thead class="bg-light">
                <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Quantity</th>
                </tr>
            </thead>
            <tbody>
                ${items}
            </tbody>
        </table>
   `;
}

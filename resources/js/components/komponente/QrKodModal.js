import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class QrKodModal extends Component {

    constructor(props) {
        super(props);

        this.state = {
            ustanove: [],
            vakcine: []
        };
    }


    render() {
        return (
            <React.Fragment>
                <a class="" data-toggle="modal" data-target="#qrKodModal">
                    Launch demo modal
                </a>

                <div class="modal fade" id="qrKodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">QR Kod prijave</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-6">
                                    <div class="card">
                                        <img class="card-img-top" src={`${this.props.src}`} />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Izadji</button>
                            </div>
                        </div>
                    </div>
                </div>
            </React.Fragment>
        );
    }
}


import React, {Component} from 'react';
import {
    Form
} from 'reactstrap'

export class ProductsForm extends Component {
    constructor(props) {
        super(props)

        this.state = {
            product: null,
            products: [],
        }
        this.onProductChange = this.onProductChange.bind(this)
    }

    componentWillReceiveProps(nextProps) {
        this.setState(
            {
                product: nextProps.product ? nextProps.product : null,
            }
        );
    }

    onAddressChange (e) {
        this.props.setAddress(e.target.value)
    }

    onProductChange(e) {
        this.props.setProduct(e.target.value)
    }

    render() {
        return (
            <Form className="filter-form">
                <h3>Products</h3>
                <div onChange={this.onProductChange}>
                {Object.keys(this.props.products).map((i) => {
                    return (<p>
                    <label>
                        <input
                            type="radio"
                            value={this.props.products[i].id}
                            checked={this.state.product === this.props.products[i].id}
                            onChange={this.onProductChange}
                        />
                        {this.props.products[i].name}
                    </label>
                    </p>)
                })}
                </div>
            </Form>
        )
    }
}

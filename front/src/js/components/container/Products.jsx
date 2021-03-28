import React, {Component} from 'react';
import SpinnerLoading from './SpinnerLoading.jsx';
import { ProductsForm} from './ProductsForm.jsx';
import {Button} from "reactstrap";
import API from "../../API/products";
import Availability from "./Availability";
import Container from 'react-bootstrap/Container'
import Row from 'react-bootstrap/Row'
import Col from 'react-bootstrap/Col'

export class Products extends Component {
  constructor(props) {
    super(props)

    this.state = {
      product: null,
      products: [],
      isLoading: false,
      productAvailability: []
    }
    this.setProduct = this.setProduct.bind(this)
    this.getProducts = this.getProducts.bind(this)
    this.getProductAvailability = this.getProductAvailability.bind(this)
  }

  componentDidMount() {
    this.getProducts()
  }

  setProduct(product) {
    this.setState({product: product, productAvailability: []})
  }

  async getProductAvailability() {
    this.setState({isLoading: true})
    try {
      const data = await API.getProductAvailability(this.state.product)
      this.setState({isLoading: false, error: '', productAvailability: data.data})
    } catch (e) {
      this.setState({
        isLoading: false,
        error: e.error ? e.error : 'Server error',
        orderData: []
      })
    }
  }

  async getProducts() {
    this.setState({isLoading: true})

    try {
      const data = await API.getProducts()
      this.setState({isLoading: false, error: '', products: data.data})
    } catch (e) {
      this.setState({
        isLoading: false,
        error: e.error ? e.error : 'Server error',
      })
    }
  }

  render() {
    return (
        <Container>
          <Row>
            <Col xs={4}>
              {this.state.products.length > 0 && (
                  <ProductsForm
                      product={this.state.product}
                      products={this.state.products}
                      setAddress={this.setAddress}
                      setProduct={this.setProduct}
                  />
              )}
              {this.state.isLoading && (
                  <SpinnerLoading/>
              )}
              {this.state.error && (
                  <p style={{color: 'red'}}>{this.state.error}</p>
              )}
              {this.state.product && (
                  <Button onClick={this.getProductAvailability}>Check product availability</Button>
              )}
            </Col>
            <Col xs={4}>
              {this.state.productAvailability.length > 0 && (
                  <Availability
                      availability={this.state.productAvailability}
                  />
              )}
            </Col>
          </Row>
        </Container>
    )
  }
}

/// <reference types="vite/client" />

interface Product {
  id: number,
  name: string,
  price: number | string,
  quantity: number,
  originalPrice: number,
  product?: ProductRelation
}

interface ProductRelation {
  id: number,
  name: string,
  price: number,
  quantity: number,
}

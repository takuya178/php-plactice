class FoodCombinationsController < ApplicationController
  def index
    @component_params = params[:component]
    genre_params = params[:genre]
    component_ids = Tag.where(id: @component_params)
    genre_ids = Tag.where(id: genre_params)

    @sugar = Tag.find_by(id: component_ids, component: 'sugar')
    @lipid = Tag.find_by(id: component_ids, component: 'lipid')
    @salt = Tag.find_by(id: component_ids, component: 'salt')
    @noodle = Tag.find_by(id: genre_ids, genre: 'noodle')
    @rice = Tag.find_by(id: genre_ids, genre: 'rice')
    @bread = Tag.find_by(id: genre_ids, genre: 'bread')
    @snack = Tag.find_by(id: genre_ids, genre: 'snack')

    selection = params[:keyword]
    @q = FoodCombination.ransack(params[:q])
    @foods = @q.result(distinct: true).eager_load(:main, :sub).all.page(params[:page])



  end

  def select; end

  def overdose
    @component = params[:componentId]
    @component_params = params[:component]
    genre_params = params[:genre]
    component_ids = Tag.where(id: @component_params)
    genre_ids = Tag.where(id: genre_params)

    @sugar = Tag.find_by(id: component_ids, component: 'sugar')
    @lipid = Tag.find_by(id: component_ids, component: 'lipid')
    @salt = Tag.find_by(id: component_ids, component: 'salt')
    @noodle = Tag.find_by(id: genre_ids, genre: 'noodle')
    @rice = Tag.find_by(id: genre_ids, genre: 'rice')
    @bread = Tag.find_by(id: genre_ids, genre: 'bread')
    @snack = Tag.find_by(id: genre_ids, genre: 'snack')

    @q = FoodCombination.ransack(params[:q])
    @foods = @q.result(distinct: true).eager_load(:main, :sub).all.page(params[:page])
  end

end

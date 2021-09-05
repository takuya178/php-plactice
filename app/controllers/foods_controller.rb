class FoodsController < ApplicationController
  def index
    @tags = Tag.all

  end

  def select; end

  def check; end

  def result
    sugar_id = params[:sugar]
    lipid_id = params[:lipid]
    salt_id = params[:salt]

    sugar_where = Tag.where(id: sugar_id)
    @sugar = Tag.find_by(id: sugar_id)

    lipid_where = Tag.where(id: lipid_id)
    @lipid = Tag.find_by(id: lipid_id)

    salt_where = Tag.where(id: salt_id)
    @salt = Tag.find_by(id: salt_id)
    
  end

  def genre_select; end

end

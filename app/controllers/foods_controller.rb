class FoodsController < ApplicationController
  def index
    @noodles = Noodle.all
    @noodle_sub = NoodleSub.all
    @noodle_intermediate = NoodleIntermediate.all
  end

  def select; end

  def genre_select; end
end

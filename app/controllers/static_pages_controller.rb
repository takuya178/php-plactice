class StaticPagesController < ApplicationController
  skip_before_action :require_login, only: %i[home privacy terms explanation]
  before_action :redirect_to_page, only: :home

  def home; end

  def privacy; end

  def terms; end

  def explanation; end

  private

  def redirect_to_page
    return unless logged_in?

    redirect_to select_food_combinations_path
  end
end
